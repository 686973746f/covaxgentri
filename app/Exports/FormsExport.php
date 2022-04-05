<?php

namespace App\Exports;

use App\Models\Forms;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class FormsExport implements FromCollection, WithMapping, WithHeadings
{

    //use Exportable;
    
    public function __construct(array $id, $type)
    {
        $this->id = $id;
        $this->type = $type;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $list = $this->id;
        
        if(in_array(0, $this->id)) {
            return Forms::all();
        }
        else {
            if($this->type == 'export') {
                //Normal Export, Hiwalay Lasalle and ONI
                $list_lasalle = Forms::with('records')
                ->whereIn('id', $list)
                ->whereHas('records', function ($query) {
                    $query->whereNull('philhealth');
                })->get();

                $list_lasalle = $list_lasalle->sortBy('records.lname');

                $list_oni = Forms::with('records')
                ->whereIn('id', $list)
                ->whereHas('records', function ($query) {
                    $query->whereNotNull('philhealth');
                })->get();

                $list_oni = $list_oni->sortBy('records.lname');

                $data = $list_lasalle->merge($list_oni);
            }
            else if($this->type == 'export_alphabetic') {
                //Alphabetic Sort
                $data = Forms::with('records')
                ->whereIn('id', $list)->get();
    
                $data = $data->sortBy('records.lname');
            }
            else if($this->type == 'export_alphabetic_withp' || $this->type == 'export_alphabetic_withp2') {
                //Get Pregnant
                $pregnant = Forms::with('records')
                ->whereIn('id', $list)
                ->whereHas('records', function ($q) {
                    $q->where('isPregnant', 1);
                });

                $pregnant_col = $pregnant->get()->sortBy('records.lname');

                $list = array_diff($list, $pregnant->pluck('id')->toArray());

                //Get Senior
                $senior = Forms::with('records')
                ->whereIn('id', $list)
                ->whereHas('records', function ($q) {
                    $q->whereRaw('TIMESTAMPDIFF(YEAR, bdate, CURDATE()) >= 60');
                });

                $senior_col = $senior->get()->sortBy('records.lname');

                $list = array_diff($list, $senior->pluck('id')->toArray());

                //Get Hospitalization
                $hospitalization = Forms::whereIn('id', $list)
                ->where('isForHospitalization', 1);

                $hospitalization_col = $hospitalization->get()->sortBy('records.lname');

                $list = array_diff($list, $hospitalization->pluck('id')->toArray());

                if($this->type == 'export_alphabetic_withp') {
                    $normal_col = Forms::whereIn('id', $list)
                    ->get()->sortBy('records.lname');

                    $data = $pregnant_col->merge($senior_col)->merge($hospitalization_col)->merge($normal_col);
                }
                else {
                    $phfirst_col = Forms::whereIn('id', $list)
                    ->whereHas('records', function ($q) {
                        $q->whereNotNull('philhealth');
                    })->get()->sortBy('records.lname');

                    $list = array_diff($list, $phfirst_col->pluck('id')->toArray());

                    $normal_col = Forms::whereIn('id', $list)
                    ->get()->sortBy('records.lname');

                    $data = $pregnant_col->merge($senior_col)->merge($hospitalization_col)->merge($phfirst_col)->merge($normal_col);
                }
            }

            return $data;
        }
    }

    public function map($form): array {
        $arr_existingCase = explode(",", $form->existingCaseList);
        $arr_testingcat = explode(",", $form->testingCat);
        $first_testingcat = head(explode(',', $form->testingCat));
        $arr_sas = explode(",", $form->SAS);
        $arr_como = explode(",", $form->COMO);
        $arr_placeVisited = explode(",", $form->placevisited);

        if($form->expoitem2 == 0) {
            $ei2str = "NO";
        }
        else if($form->expoitem2 == 1) {
            $ei2str = "YES, LOCAL";
        }
        else if ($form->expoitem2 == 2) {
            $ei2str = "YES, INTERNATIONAL";
        }
        else if ($form->expoitem2 == 3) {
            $ei2str = "UNKNOWN";
        }

        if(is_null($form->testType2)) {
            $displayFirstTestDateCollected = date('m/d/Y', strtotime($form->testDateCollected1));
            $displayFirstTimeCollected = (!is_null($form->oniTimeCollected1)) ? date('g:i A', strtotime($form->oniTimeCollected1)) : '';
            $displayFirstTestDateRelease = (!is_null($form->testDateReleased1)) ? date('m/d/Y', strtotime($form->testDateReleased1)) : 'N/A';
            $displayFirstLaboratory = strtoupper($form->testLaboratory1);
            $displayFirstTestType = $form->testType1;
            $displayFirstAntigenRemarks = ($form->testType1 == "ANTIGEN") ? $form->testTypeAntigenRemarks1 : "N/A";
            $displayFirstAntigenKit = ($form->testType1 == "ANTIGEN") ? mb_strtoupper($form->antigenKit1) : "N/A";
            $displayFirstTestTypeOtherRemarks = ($form->testType1 == "OTHERS") ? $form->testTypeOtherRemarks1 : "N/A";
            $displayFirstTestResult = $form->testResult1;
            $displayFirstTestResultOtherRemarks = ($form->testResult1 == "OTHERS") ? $form->testResultOtherRemarks1 : "N/A";

            $displaySecondTestDateCollected = "N/A";
            $displaySecondTimeCollected = '';
            $displaySecondTestDateRelease = "N/A";
            $displaySecondLaboratory = "N/A";
            $displaySecondTestType = "N/A";
            $displaySecondAntigenRemarks = "N/A";
            $displaySecondAntigenKit = "N/A";
            $displaySecondTestTypeOtherRemarks = "N/A";
            $displaySecondTestResult = "N/A";
            $displaySecondTestResultOtherRemarks = "N/A";
        }
        else {
            //ilalagay sa unahan yung pangalawang swab dahil mas bago ito
            $displayFirstTestDateCollected = date('m/d/Y', strtotime($form->testDateCollected2));
            $displayFirstTimeCollected = (!is_null($form->oniTimeCollected2)) ? date('g:i A', strtotime($form->oniTimeCollected2)) : '';
            $displayFirstTestDateRelease = (!is_null($form->testDateReleased2)) ? date('m/d/Y', strtotime($form->testDateReleased2)) : 'N/A';
            $displayFirstLaboratory = strtoupper($form->testLaboratory2);
            $displayFirstTestType = $form->testType2;
            $displayFirstAntigenRemarks = ($form->testType2 == "ANTIGEN") ? $form->testTypeAntigenRemarks2 : "N/A";
            $displayFirstAntigenKit = ($form->testType2 == "ANTIGEN") ? mb_strtoupper($form->antigenKit2) : "N/A";
            $displayFirstTestTypeOtherRemarks = ($form->testType2 == "OTHERS") ? $form->testTypeOtherRemarks2 : "N/A";
            $displayFirstTestResult = $form->testResult2;
            $displayFirstTestResultOtherRemarks = ($form->testResult2 == "OTHERS") ? $form->testResultOtherRemarks2 : "N/A";

            $displaySecondTestDateCollected = date('m/d/Y', strtotime($form->testDateCollected1));
            $displaySecondTimeCollected = (!is_null($form->oniTimeCollected1)) ? date('g:i A', strtotime($form->oniTimeCollected1)) : '';
            $displaySecondTestDateRelease = (!is_null($form->testDateReleased1)) ? date('m/d/Y', strtotime($form->testDateReleased1)) : 'N/A';
            $displaySecondLaboratory = strtoupper($form->testLaboratory1);
            $displaySecondTestType = $form->testType1;
            $displaySecondAntigenRemarks = ($form->testType1 == "ANTIGEN") ? $form->testTypeAntigenRemarks1 : "N/A";
            $displaySecondAntigenKit = ($form->testType1 == "ANTIGEN") ? mb_strtoupper($form->antigenKit1) : "N/A";
            $displaySecondTestTypeOtherRemarks = ($form->testType1 == "OTHERS") ? $form->testTypeOtherRemarks1 : "N/A";
            $displaySecondTestResult = $form->testResult1;
            $displaySecondTestResultOtherRemarks = ($form->testResult1 == "OTHERS") ? $form->testResultOtherRemarks1 : "N/A";
        }

        //Colds in SX
        if(in_array("Others", $arr_sas)) {
            if(in_array("Colds", $arr_sas)) {
                $auto_othersx = strtoupper($form->SASOtherRemarks).', Colds';
            }
            else {
                $auto_othersx = strtoupper($form->SASOtherRemarks);
            }
        }
        else {
            if(in_array("Colds", $arr_sas)) {
                $auto_othersx = 'Colds';
            }
            else {
                $auto_othersx = 'N/A';
            }
        }

        return [
            $form->drunit,
            $form->drregion." ".$form->drprovince,
            '',
            //(!is_null($form->records->philhealth)) ? $form->records->getPhilhealth() : "N/A",
            strtoupper($form->interviewerName),
            $form->interviewerMobile,
            date('m/d/Y', strtotime($form->interviewDate)),
            (!is_null($form->informantName)) ? strtoupper($form->informantName) : 'N/A',
            (!is_null($form->informantRelationship)) ? strtoupper($form->informantRelationship) : 'N/A',
            (!is_null($form->informantMobile)) ? $form->informantMobile : 'N/A',

            (in_array("1", $arr_existingCase)) ? "YES" : "NO",
            (in_array("2", $arr_existingCase)) ? "YES" : "NO",
            (in_array("3", $arr_existingCase)) ? "YES" : "NO",
            (in_array("4", $arr_existingCase)) ? "YES" : "NO",
            (in_array("5", $arr_existingCase)) ? "YES" : "NO",
            (in_array("6", $arr_existingCase)) ? "YES" : "NO",
            (in_array("7", $arr_existingCase)) ? "YES" : "NO",
            (in_array("8", $arr_existingCase)) ? "YES" : "NO",
            (in_array("9", $arr_existingCase)) ? "YES" : "NO",
            (in_array("10", $arr_existingCase)) ? "YES" : "NO",
            (in_array("11", $arr_existingCase)) ? "YES" : "NO",
            (in_array("11", $arr_existingCase)) ? mb_strtoupper($form->ecOthersRemarks) : "N/A",
            
            $form->pType,
            $form->caseClassification,
            /*
            (in_array("A", $arr_testingcat)) ? "YES" : "NO",
            (in_array("B", $arr_testingcat)) ? "YES" : "NO",
            (in_array("C", $arr_testingcat)) ? "YES" : "NO",
            (in_array("D.1", $arr_testingcat) || in_array("D.2", $arr_testingcat) || in_array("D.3", $arr_testingcat) || in_array("D.4", $arr_testingcat)) ? "YES" : "NO",
            (in_array("E.1", $arr_testingcat) || in_array("E.2", $arr_testingcat)) ? "YES" : "NO",
            (in_array("F", $arr_testingcat)) ? "YES" : "NO",
            (in_array("G", $arr_testingcat)) ? "YES" : "NO",
            (in_array("H.1", $arr_testingcat) || in_array("H.2", $arr_testingcat)) ? "YES" : "NO",
            (in_array("I", $arr_testingcat)) ? "YES" : "NO",
            (in_array("J.1", $arr_testingcat) || in_array("J.2", $arr_testingcat)) ? "YES" : "NO",
            */
            ($first_testingcat == "A") ? "YES" : "NO",
            ($first_testingcat == "B") ? "YES" : "NO",
            ($first_testingcat == "C") ? "YES" : "NO",
            ($first_testingcat == "D.1" || $first_testingcat == "D.2" || $first_testingcat == "D.3" || $first_testingcat == "D.4") ? "YES" : "NO",
            ($first_testingcat == "E.1" || $first_testingcat == "E.2") ? "YES" : "NO",
            ($first_testingcat == "F") ? "YES" : "NO",
            ($first_testingcat == "G") ? "YES" : "NO",
            ($first_testingcat == "H.1" || $first_testingcat == "H.2") ? "YES" : "NO",
            ($first_testingcat == "I") ? "YES" : "NO",
            ($first_testingcat == "J.1" || $first_testingcat == "J.2") ? "YES" : "NO",
            $first_testingcat,
            
            $form->records->lname,
            $form->records->fname,
            $form->records->mname,
            date('m/d/Y', strtotime($form->records->bdate)),
            $form->records->getAge(),
            $form->records->gender,
            substr($form->records->gender,0,1),
            $form->records->cs,
            $form->records->nationality,
            ($form->records->ifCompleteWorkplaceInfo()) ? $form->records->occupation : 'N/A',
            $form->records->worksInClosedSetting,

            //current address
            $form->records->address_houseno,
            $form->records->address_street,
            $form->records->address_brgy,
            $form->records->address_city,
            $form->records->address_province,
            (!is_null($form->records->phoneno)) ? $form->records->phoneno : 'N/A',
            $form->records->mobile,
            (!is_null($form->records->email)) ? $form->records->email : 'N/A',

            //perma address
            $form->records->permaaddress_houseno,
            $form->records->permaaddress_street,
            $form->records->permaaddress_brgy,
            $form->records->permaaddress_city,
            $form->records->permaaddress_province,
            (!is_null($form->records->permaphoneno)) ? $form->records->permaphoneno : 'N/A',
            $form->records->permamobile,
            (!is_null($form->records->permaemail)) ? $form->records->permaemail : 'N/A',

            (!is_null($form->records->occupation_lotbldg)) ? $form->records->occupation_lotbldg : 'N/A',
            (!is_null($form->records->occupation_street)) ? $form->records->occupation_street : 'N/A',
            (!is_null($form->records->occupation_brgy)) ? $form->records->occupation_brgy : 'N/A',
            (!is_null($form->records->occupation_city)) ? $form->records->occupation_city : 'N/A',
            (!is_null($form->records->occupation_province)) ? $form->records->occupation_province : 'N/A',
            (!is_null($form->records->occupation_name)) ? $form->records->occupation_name : 'N/A',
            (!is_null($form->records->occupation_mobile)) ? $form->records->occupation_mobile : 'N/A',
            (!is_null($form->records->occupation_email)) ? $form->records->occupation_email : 'N/A',

            ($form->isHealthCareWorker == 1) ? 'YES' : 'NO',
            ($form->isHealthCareWorker == 1) ? mb_strtoupper($form->healthCareCompanyName) : 'N/A',
            ($form->isHealthCareWorker == 1) ? mb_strtoupper($form->healthCareCompanyLocation) : 'N/A',
            
            ($form->isOFW == 1) ? 'YES' : 'NO',
            ($form->isOFW == 1) ? mb_strtoupper($form->OFWCountyOfOrigin) : 'N/A',
            ($form->isOFW == 1) ? $form->OFWPassportNo : 'N/A',
            ($form->isOFW == 1 && $form->ofwType == 1) ? "YES" : "NO",
            ($form->isOFW == 1 && $form->ofwType == 2) ? "YES" : "NO",

            ($form->isFNT == 1) ? 'YES' : 'NO',
            ($form->isFNT == 1) ? mb_strtoupper($form->FNTCountryOfOrigin) : 'N/A',
            ($form->isFNT == 1) ? $form->FNTPassportNo : 'N/A',

            ($form->isLSI == 1) ? 'YES' : 'NO',
            ($form->isLSI == 1) ? strtoupper($form->LSICity).", ".strtoupper($form->LSIProvince) : 'N/A',
            ($form->isLSI == 1 && $form->lsiType == 1) ? 'YES' : 'NO',
            ($form->isLSI == 1 && $form->lsiType == 0) ? 'YES' : 'NO',

            ($form->isLivesOnClosedSettings == 1) ? 'YES' : 'NO',
            ($form->isLivesOnClosedSettings == 1) ? strtoupper($form->institutionType) : 'N/A',
            ($form->isLivesOnClosedSettings == 1) ? mb_strtoupper($form->institutionName) : 'N/A',

            ($form->havePreviousCovidConsultation == 1) ? 'YES' : 'NO',
            (!is_null($form->dateOfFirstConsult)) ? date("m/d/Y", strtotime($form->dateOfFirstConsult)) : 'N/A',
            (!is_null($form->facilityNameOfFirstConsult)) ? strtoupper($form->facilityNameOfFirstConsult) : 'N/A',
            
            ($form->dispoType == 1) ? 'YES' : 'NO',
            ($form->dispoType == 1) ? strtoupper($form->dispoName) : 'N/A',
            ($form->dispoType == 1) ? date("m/d/Y H:i", strtotime($form->dispoDate)) : 'N/A',

            ($form->dispoType == 2) ? 'YES' : 'NO',
            ($form->dispoType == 2) ? strtoupper($form->dispoName) : 'N/A',
            ($form->dispoType == 2) ? date("m/d/Y H:i", strtotime($form->dispoDate)) : 'N/A',

            ($form->dispoType == 3) ? 'YES' : 'NO',
            ($form->dispoType == 3) ? date("m/d/Y H:i", strtotime($form->dispoDate)) : 'N/A',

            ($form->dispoType == 4) ? 'YES' : 'NO',
            ($form->dispoType == 4) ? date("m/d/Y", strtotime($form->dispoDate)) : 'N/A',

            ($form->dispoType == 5) ? 'YES' : 'NO',
            ($form->dispoType == 5) ? strtoupper($form->dispoName) : 'N/A',

            ($form->healthStatus == "Asymptomatic") ? 'YES' : 'NO',
            ($form->healthStatus == "Mild") ? 'YES' : 'NO',
            ($form->healthStatus == "Moderate") ? 'YES' : 'NO',
            ($form->healthStatus == "Severe") ? 'YES' : 'NO',
            ($form->healthStatus == "Critical") ? 'YES' : 'NO',

            ($form->caseClassification == "Suspect") ? 'YES' : 'NO',
            ($form->caseClassification == "Probable") ? 'YES' : 'NO',
            ($form->caseClassification == "Confirmed") ? 'YES' : 'NO',
            ($form->caseClassification == "Non-COVID-19 Case") ? 'YES' : 'NO',

            (!is_null($form->records->vaccinationDate1)) ? date('m/d/Y', strtotime($form->records->vaccinationDate1)) : 'N/A',
            (!is_null($form->records->vaccinationDate1)) ? mb_strtoupper($form->records->vaccinationName1) : 'N/A',
            (!is_null($form->records->vaccinationDate1)) ? mb_strtoupper($form->records->vaccinationNoOfDose1) : 'N/A',
            (!is_null($form->records->vaccinationDate1)) ? mb_strtoupper($form->records->vaccinationFacility1) : 'N/A',
            (!is_null($form->records->vaccinationDate1)) ? mb_strtoupper($form->records->vaccinationRegion1) : 'N/A',
            (!is_null($form->records->vaccinationDate1) && $form->records->haveAdverseEvents1 == 1) ? 'YES' : 'NO',

            (!is_null($form->records->vaccinationDate2)) ? date('m/d/Y', strtotime($form->records->vaccinationDate2)) : 'N/A',
            (!is_null($form->records->vaccinationDate2)) ? mb_strtoupper($form->records->vaccinationName2) : 'N/A',
            (!is_null($form->records->vaccinationDate2)) ? mb_strtoupper($form->records->vaccinationNoOfDose2) : 'N/A',
            (!is_null($form->records->vaccinationDate2)) ? mb_strtoupper($form->records->vaccinationFacility2) : 'N/A',
            (!is_null($form->records->vaccinationDate2)) ? mb_strtoupper($form->records->vaccinationRegion2) : 'N/A',
            (!is_null($form->records->vaccinationDate2) && $form->records->haveAdverseEvents2 == 1) ? 'YES' : 'NO',

            (!is_null($form->dateOnsetOfIllness)) ? date("m/d/Y", strtotime($form->dateOnsetOfIllness)) : 'N/A',
            (in_array("Asymptomatic", $arr_sas)) ? "YES" : "NO",
            (in_array("Fever", $arr_sas)) ? "YES" : "NO",
            (in_array("Fever", $arr_sas)) ? $form->SASFeverDeg : "",
            (in_array("Cough", $arr_sas)) ? "YES" : "NO",
            (in_array("General Weakness", $arr_sas)) ? "YES" : "NO",
            (in_array("Fatigue", $arr_sas)) ? "YES" : "NO",
            (in_array("Headache", $arr_sas)) ? "YES" : "NO",
            (in_array("Myalgia", $arr_sas)) ? "YES" : "NO",
            (in_array("Sore throat", $arr_sas)) ? "YES" : "NO",
            (in_array("Coryza", $arr_sas)) ? "YES" : "NO",
            (in_array("Dyspnea", $arr_sas)) ? "YES" : "NO",
            (in_array("Anorexia", $arr_sas)) ? "YES" : "NO",
            (in_array("Nausea", $arr_sas)) ? "YES" : "NO",
            (in_array("Vomiting", $arr_sas)) ? "YES" : "NO",
            (in_array("Diarrhea", $arr_sas)) ? "YES" : "NO",
            (in_array("Altered Mental Status", $arr_sas)) ? "YES" : "NO",
            (in_array("Anosmia (Loss of Smell)", $arr_sas)) ? "YES" : "NO",
            (in_array("Ageusia (Loss of Taste)", $arr_sas)) ? "YES" : "NO",
            (in_array("Others", $arr_sas)) ? "YES" : "NO",
            $auto_othersx,

            (in_array("None", $arr_como)) ? "YES" : "NO",
            (in_array("Hypertension", $arr_como)) ? "YES" : "NO",
            (in_array("Diabetes", $arr_como)) ? "YES" : "NO",
            (in_array("Heart Disease", $arr_como)) ? "YES" : "NO",
            (in_array("Lung Disease", $arr_como)) ? "YES" : "NO",
            (in_array("Gastrointestinal", $arr_como)) ? "YES" : "NO",
            (in_array("Genito-urinary", $arr_como)) ? "YES" : "NO",
            (in_array("Neurological Disease", $arr_como)) ? "YES" : "NO",
            (in_array("Cancer", $arr_como)) ? "YES" : "NO",
            (in_array("Others", $arr_como)) ? "YES" : "NO",
            (in_array("Others", $arr_como)) ? strtoupper($form->COMOOtherRemarks) : "N/A",
            ($form->records->isPregnant == 1) ? "YES" : "NO",
            ($form->records->isPregnant == 1) ? date('m/d/Y', strtotime($form->PregnantLMP)) : "N/A",
            ($form->PregnantHighRisk == 1) ? "YES" : "NO",

            ($form->diagWithSARI == 1) ? "YES" : "NO",
            ($form->imagingDone != "None") ? date('m/d/Y', strtotime($form->imagingDoneDate)) : "N/A",
            $form->imagingDone,
            $form->imagingResult,
            ($form->imagingResult == "OTHERS") ? strtoupper($form->imagingOtherFindings) : "N/A",

            ($form->testedPositiveUsingRTPCRBefore == 1) ? "YES" : "NO",
            ($form->testedPositiveUsingRTPCRBefore == 1) ? date("m/d/Y", strtotime($form->testedPositiveSpecCollectedDate)) : "N/A",
            ($form->testedPositiveUsingRTPCRBefore == 1) ? strtoupper($form->testedPositiveLab) : "N/A",
            strval($form->testedPositiveNumOfSwab),

            $displayFirstTestDateCollected,
            $displayFirstTimeCollected,
            $displayFirstTestDateRelease,
            $displayFirstLaboratory,
            $displayFirstTestType,
            $displayFirstAntigenRemarks,
            $displayFirstAntigenKit,
            $displayFirstTestTypeOtherRemarks,
            $displayFirstTestResult,
            $displayFirstTestResultOtherRemarks,

            $displaySecondTestDateCollected,
            $displaySecondTimeCollected,
            $displaySecondTestDateRelease,
            $displaySecondLaboratory,
            $displaySecondTestType,
            $displaySecondAntigenRemarks,
            $displaySecondAntigenKit,
            $displaySecondTestTypeOtherRemarks,
            $displaySecondTestResult,
            $displaySecondTestResultOtherRemarks,

            ($form->outcomeCondition == "Active") ? "YES" : "NO",
            ($form->outcomeCondition == "Recovered") ? "YES" : "NO",
            ($form->outcomeCondition == "Recovered") ? date("m/d/Y", strtotime($form->outcomeRecovDate)) : "N/A",
            ($form->outcomeCondition == "Died") ? "YES" : "NO",
            ($form->outcomeCondition == "Died") ? date("m/d/Y", strtotime($form->outcomeDeathDate)) : "N/A",
            ($form->outcomeCondition == "Died") ? strtoupper($form->deathImmeCause) : "N/A",
            ($form->outcomeCondition == "Died") ? strtoupper($form->deathAnteCause) : "N/A",
            ($form->outcomeCondition == "Died") ? strtoupper($form->deathUndeCause) : "N/A",
            ($form->outcomeCondition == "Died") ? strtoupper($form->contriCondi) : "N/A",

            ($form->expoitem1 == 1) ? "YES" : "NO",
            ($form->expoitem1 == 1) ? date("m/d/Y", strtotime($form->expoDateLastCont)) : "N/A",

            $ei2str,
            ($form->expoitem2 == 2) ? strtoupper($form->intCountry) : 'N/A',
            ($form->expoitem2 == 2) ? date('m/d/Y', strtotime($form->intDateFrom)) : 'N/A',
            ($form->expoitem2 == 2) ? date('m/d/Y', strtotime($form->intDateTo)) : 'N/A',
            ($form->expoitem2 == 2 && $form->intWithOngoingCovid != "N/A") ? $form->intWithOngoingCovid : 'N/A',
            ($form->expoitem2 == 2) ? $form->intVessel : 'N/A',
            ($form->expoitem2 == 2) ? $form->intVesselNo : 'N/A',
            ($form->expoitem2 == 2) ? $form->intDateDepart : 'N/A',
            ($form->expoitem2 == 2) ? $form->intDateArrive : 'N/A',

            ($form->expoitem2 == 1 && in_array("Health Facility", $arr_placeVisited)) ? "YES" : "NO",
            ($form->expoitem2 == 1 && in_array("Health Facility", $arr_placeVisited)) ? strtoupper($form->locName1) : "N/A",
            ($form->expoitem2 == 1 && in_array("Health Facility", $arr_placeVisited)) ? strtoupper($form->locAddress1) : "N/A",
            ($form->expoitem2 == 1 && in_array("Health Facility", $arr_placeVisited)) ? date('m/d/Y', strtotime($form->locDateFrom1)) : "N/A",
            ($form->expoitem2 == 1 && in_array("Health Facility", $arr_placeVisited)) ? date('m/d/Y', strtotime($form->locDateTo1)) : "N/A",
            ($form->expoitem2 == 1 && in_array("Health Facility", $arr_placeVisited) && $form->locWithOngoingCovid1 != "N/A") ? $form->locWithOngoingCovid1 : "N/A",

            ($form->expoitem2 == 1 && in_array("Closed Settings", $arr_placeVisited)) ? "YES" : "NO",
            ($form->expoitem2 == 1 && in_array("Closed Settings", $arr_placeVisited)) ? strtoupper($form->locName2) : "N/A",
            ($form->expoitem2 == 1 && in_array("Closed Settings", $arr_placeVisited)) ? strtoupper($form->locAddress2) : "N/A",
            ($form->expoitem2 == 1 && in_array("Closed Settings", $arr_placeVisited)) ? date('m/d/Y', strtotime($form->locDateFrom2)) : "N/A",
            ($form->expoitem2 == 1 && in_array("Closed Settings", $arr_placeVisited)) ? date('m/d/Y', strtotime($form->locDateTo2)) : "N/A",
            ($form->expoitem2 == 1 && in_array("Closed Settings", $arr_placeVisited) && $form->locWithOngoingCovid2 != "N/A") ? $form->locWithOngoingCovid2 : "N/A",

            ($form->expoitem2 == 1 && in_array("School", $arr_placeVisited)) ? "YES" : "NO",
            ($form->expoitem2 == 1 && in_array("School", $arr_placeVisited)) ? strtoupper($form->locName3) : "N/A",
            ($form->expoitem2 == 1 && in_array("School", $arr_placeVisited)) ? strtoupper($form->locAddress3) : "N/A",
            ($form->expoitem2 == 1 && in_array("School", $arr_placeVisited)) ? date('m/d/Y', strtotime($form->locDateFrom3)) : "N/A",
            ($form->expoitem2 == 1 && in_array("School", $arr_placeVisited)) ? date('m/d/Y', strtotime($form->locDateTo3)) : "N/A",
            ($form->expoitem2 == 1 && in_array("School", $arr_placeVisited) && $form->locWithOngoingCovid3 != "N/A") ? $form->locWithOngoingCovid3 : "N/A",

            ($form->expoitem2 == 1 && in_array("Workplace", $arr_placeVisited)) ? "YES" : "NO",
            ($form->expoitem2 == 1 && in_array("Workplace", $arr_placeVisited)) ? strtoupper($form->locName4) : "N/A",
            ($form->expoitem2 == 1 && in_array("Workplace", $arr_placeVisited)) ? strtoupper($form->locAddress4) : "N/A",
            ($form->expoitem2 == 1 && in_array("Workplace", $arr_placeVisited)) ? date('m/d/Y', strtotime($form->locDateFrom4)) : "N/A",
            ($form->expoitem2 == 1 && in_array("Workplace", $arr_placeVisited)) ? date('m/d/Y', strtotime($form->locDateTo4)) : "N/A",
            ($form->expoitem2 == 1 && in_array("Workplace", $arr_placeVisited) && $form->locWithOngoingCovid4 != "N/A") ? $form->locWithOngoingCovid4 : "N/A",

            ($form->expoitem2 == 1 && in_array("Market", $arr_placeVisited)) ? "YES" : "NO",
            ($form->expoitem2 == 1 && in_array("Market", $arr_placeVisited)) ? strtoupper($form->locName5) : "N/A",
            ($form->expoitem2 == 1 && in_array("Market", $arr_placeVisited)) ? strtoupper($form->locAddress5) : "N/A",
            ($form->expoitem2 == 1 && in_array("Market", $arr_placeVisited)) ? date('m/d/Y', strtotime($form->locDateFrom5)) : "N/A",
            ($form->expoitem2 == 1 && in_array("Market", $arr_placeVisited)) ? date('m/d/Y', strtotime($form->locDateTo5)) : "N/A",
            ($form->expoitem2 == 1 && in_array("Market", $arr_placeVisited) && $form->locWithOngoingCovid5 != "N/A") ? $form->locWithOngoingCovid5 : "N/A",

            ($form->expoitem2 == 1 && in_array("Social Gathering", $arr_placeVisited)) ? "YES" : "NO",
            ($form->expoitem2 == 1 && in_array("Social Gathering", $arr_placeVisited)) ? strtoupper($form->locName6) : "N/A",
            ($form->expoitem2 == 1 && in_array("Social Gathering", $arr_placeVisited)) ? strtoupper($form->locAddress6) : "N/A",
            ($form->expoitem2 == 1 && in_array("Social Gathering", $arr_placeVisited)) ? date('m/d/Y', strtotime($form->locDateFrom6)) : "N/A",
            ($form->expoitem2 == 1 && in_array("Social Gathering", $arr_placeVisited)) ? date('m/d/Y', strtotime($form->locDateTo6)) : "N/A",
            ($form->expoitem2 == 1 && in_array("Social Gathering", $arr_placeVisited) && $form->locWithOngoingCovid6 != "N/A") ? $form->locWithOngoingCovid6 : "N/A",

            ($form->expoitem2 == 1 && in_array("Others", $arr_placeVisited)) ? "YES" : "NO",
            ($form->expoitem2 == 1 && in_array("Others", $arr_placeVisited)) ? strtoupper($form->locName7) : "N/A",
            ($form->expoitem2 == 1 && in_array("Others", $arr_placeVisited)) ? strtoupper($form->locAddress7) : "N/A",
            ($form->expoitem2 == 1 && in_array("Others", $arr_placeVisited)) ? date('m/d/Y', strtotime($form->locDateFrom7)) : "N/A",
            ($form->expoitem2 == 1 && in_array("Others", $arr_placeVisited)) ? date('m/d/Y', strtotime($form->locDateTo7)) : "N/A",
            ($form->expoitem2 == 1 && in_array("Others", $arr_placeVisited) && $form->locWithOngoingCovid7 != "N/A") ? $form->locWithOngoingCovid7 : "N/A",

            ($form->expoitem2 == 1 && in_array("Transport Service", $arr_placeVisited)) ? "YES" : "NO",
            ($form->expoitem2 == 1 && in_array("Transport Service", $arr_placeVisited) && !is_null($form->localVessel1)) ? strtoupper($form->localVessel1) : "N/A",
            ($form->expoitem2 == 1 && in_array("Transport Service", $arr_placeVisited) && !is_null($form->localVesselNo1)) ? strtoupper($form->localVesselNo1) : "N/A",
            ($form->expoitem2 == 1 && in_array("Transport Service", $arr_placeVisited) && !is_null($form->localOrigin1)) ? strtoupper($form->localOrigin1) : "N/A",
            ($form->expoitem2 == 1 && in_array("Transport Service", $arr_placeVisited) && !is_null($form->localDateDepart1)) ? date('m/d/Y', strtotime($form->localDateDepart1)) : "N/A",
            ($form->expoitem2 == 1 && in_array("Transport Service", $arr_placeVisited) && !is_null($form->localDest1)) ? strtoupper($form->localDest1) : "N/A",
            ($form->expoitem2 == 1 && in_array("Transport Service", $arr_placeVisited) && !is_null($form->localDateArrive1)) ? date('m/d/Y', strtotime($form->localDateArrive1)) : "N/A",

            ($form->expoitem2 == 1 && in_array("Transport Service", $arr_placeVisited) && !is_null($form->localVessel2)) ? strtoupper($form->localVessel2) : "N/A",
            ($form->expoitem2 == 1 && in_array("Transport Service", $arr_placeVisited) && !is_null($form->localVesselNo2)) ? strtoupper($form->localVesselNo2) : "N/A",
            ($form->expoitem2 == 1 && in_array("Transport Service", $arr_placeVisited) && !is_null($form->localOrigin2)) ? strtoupper($form->localOrigin2) : "N/A",
            ($form->expoitem2 == 1 && in_array("Transport Service", $arr_placeVisited) && !is_null($form->localDateDepart2)) ? date('m/d/Y', strtotime($form->localDateDepart2)) : "N/A",
            ($form->expoitem2 == 1 && in_array("Transport Service", $arr_placeVisited) && !is_null($form->localDest2)) ? strtoupper($form->localDest2) : "N/A",
            ($form->expoitem2 == 1 && in_array("Transport Service", $arr_placeVisited) && !is_null($form->localDateArrive2)) ? date('m/d/Y', strtotime($form->localDateArrive2)) : "N/A",

            (!is_null($form->contact1Name)) ? mb_strtoupper($form->contact1Name) : "N/A",
            (!is_null($form->contact1No)) ? $form->contact1No : "N/A",
            (!is_null($form->contact2Name)) ? mb_strtoupper($form->contact2Name) : "N/A",
            (!is_null($form->contact2No)) ? $form->contact2No : "N/A",
            (!is_null($form->contact3Name)) ? mb_strtoupper($form->contact3Name) : "N/A",
            (!is_null($form->contact3No)) ? $form->contact3No : "N/A",
            (!is_null($form->contact4Name)) ? mb_strtoupper($form->contact4Name) : "N/A",
            (!is_null($form->contact4No)) ? $form->contact4No : "N/A",

            (!is_null($form->isPresentOnSwabDay) && $form->isPresentOnSwabDay == 1) ? 'YES' : 'NO',
            ($form->isForHospitalization == 1) ? 'YES' : 'NO',
            $form->records->id,
            date('m/d/Y', strtotime('+1 Day')),
        ];
    }

    public function headings(): array
    {
        return [
            'Disease Reporting Unit',
            'DRU Region and Province',
            'Philhealth No',
            'Name of Interviewer',
            'Contact No of Interviewer',
            'Date of Interview',
            'Name of Informant',
            'Relationship',
            'Contact Number of Informant',
            'Not Applicable (New case)',
            'Not applicable (Unknown)',
            'Update symptoms',
            'Update health stats',
            'Update case classification',
            'Update vaccination',
            'Update lab result',
            'Update chest imaging findings',
            'Update disposition',
            'Update exposure',
            'Others',
            'Others, specify:',
            'Type of Client',
            'Case Classification',
            'Testing Category / Subgroup A',
            'Testing Category / Subgroup B',
            'Testing Category / Subgroup C',
            'Testing Category / Subgroup D',
            'Testing Category / Subgroup E',
            'Testing Category / Subgroup F',
            'Testing Category / Subgroup G',
            'Testing Category / Subgroup H',
            'Testing Category / Subgroup I',
            'Testing Category / Subgroup J',
            'Complete Testing Cat.',
            'Last Name',
            'First Name (and Suffix)',
            'Middle Name',
            'Birthdate',
            'Age',
            'Sex',
            'Sex Initial',
            'Civil Status',
            'Nationality',
            'Occupation',
            'Works in a closed setting',

            'House No./Lot/Bldg',
            'Street/ Purok/ Sitio',
            'Barangay',
            'Municipality/ City',
            'Province',
            'Home Phone no. (&Area Code)',
            'Cellphone No.',
            'Email adress',

            'House No./Lot/Bldg',
            'Street/ Purok/ Sitio',
            'Barangay',
            'Municipality/ City',
            'Province',
            'Home Phone no. (&Area Code)',
            'Cellphone No.',
            'Email adress',
            
            'Lot/Bldg',
            'Street',
            'Barangay',
            'Municipality / City',
            'Province',
            'Name of Workplace',
            'Phone No. / Cellphone No.',
            'Email adress',

            'Health Care Worker',
            'Name of health facility',
            'Location of health facility',

            'Returning overseas Filipino',
            'Country of Origin',
            'Passport Number',
            'OFW',
            'Non-OFW',

            'Foreign National Traveler',
            'Country of origin',
            'Passport Number',

            'LSI',
            'City, Municipality & Province of Origin',
            'Locally Stranded individual',
            'APOR or Local Traveler',

            'Lives in Closed settings',
            'Specify Type of institution',
            'Specify Name of institution',
            
            'Have previous COVID consultation',
            'Date of first consult',
            'Name of facility where first consult',

            'Admitted in Hospital',
            'Name of Hospital',
            'Date and Time admitted in hospital',

            'Admitted in isltn qrntn facility',
            'Name of Isolation qrntn facility',
            'Date and Time Isolated qrntn facility',

            'In home isolation qrntn',
            'Date and time isolated qrntn at home',

            'Discharged to home',
            'if Discharged: date of discharge',

            'Others',
            'Others: State reason',

            'Asymptomatic',
            'Mild',
            'Moderate',
            'Severe',
            'Critical',
            'Suspect',
            'Probable',
            'Confirmed',
            'Non-Covid-19 Case',

            'Date of vaccination 1',
            'Name of Vaccine 1',
            'Dose number 1',
            'Vaccination center/facility 1',
            'Region of health facility 1',
            'Adverse events 1',

            'Date of vaccination 2',
            'Name of Vaccine 2',
            'Dose number 2',
            'Vaccination center/facility 2',
            'Region of health facility 2',
            'Adverse events 2',

            'Date of Onset of Illness',
            'Asymptomatic',
            'Fever',
            '°C [N/A if empty]',
            'Cough',
            'General Weakness',
            'Fatigue',
            'Headache',
            'Myalgia',
            'Sorethroat',
            'Coryza',
            'Dyspnea',
            'Anorexia',
            'Nausea',
            'Vomiting',
            'Diarrhea',
            'Altered Mental Status',
            'Anosmia',
            'Ageusia',
            'Others',
            'Others: Specify',

            'None',
            'Hypertension',
            'Diabetes',
            'Heart Disease',
            'Lung Disease',
            'Gastrointestinal',
            'Genito-Urinary',
            'Neurological Disease',
            'Cancer',
            'Others',
            'Others, specify',
            'Pregnant',
            'LMP',
            'High risk pregnancy',

            'Was diagnosed to have SARI',
            'Date done',
            'Imaging done',
            'Results',
            'Other findings, specify',

            'Tested positive before',
            'Date of Specimen Collection',
            'Laboratory',
            'No. of Previous RT-PCR swabs done',

            'Date Collected 1',
            'Time Collected (ONI)',
            'Date Released 1',
            'Laboratory 1',
            'Type of Test 1',
            'Type of Test Antigen Reason 1',
            'Antigen Kit 1',
            'Type of Test Reason 1',
            'Results 1',
            'Results Others Specify 1',

            'Date Collected 2',
            'Time Collected 2 (ONI)',
            'Date Released 2',
            'Laboratory 2',
            'Type of Test 2',
            'Type of Test Antigen Reason 2',
            'Antigen Kit 2',
            'Type of Test Reason 2',
            'Results 2',
            'Results Others Specify 2',

            'Active',
            'Recovered',
            'Date of recovery',
            'Died',
            'date of death',
            'Immediate Cause',
            'Antecedent cause',
            'Underlying cause',
            'Contributory Conditions',

            'Have History of Exposure',
            'Date of last contact',
            'Have Travel History',
            'If Int Travel, country of origin',
            'Inclusive Travel dates FROM',
            'Inclusive Travel dates TO',
            'W ongoing COVID-19 transmission',
            'Airline/ Sea Vessel',
            'Flight/ Vessel No.',
            'Date of Departure',
            'Date of Arrival in PH',

            'Health facility',
            'Name of Place',
            'Address',
            'Inclusive Travel Dates FROM',
            'Inclusive Travel Dates TO',
            'W ongoing COVID-19 transmission',

            'Closed Settings',
            'Name of Place',
            'Address',
            'Inclusive Travel Dates FROM',
            'Inclusive Travel Dates TO',
            'W ongoing COVID-19 transmission',

            'School',
            'Name of Place',
            'Address',
            'Inclusive Travel Dates FROM',
            'Inclusive Travel Dates TO',
            'W ongoing COVID-19 transmission',

            'Workplace',
            'Name of Place',
            'Address',
            'Inclusive Travel Dates FROM',
            'Inclusive Travel Dates TO',
            'W ongoing COVID-19 transmission',

            'Market',
            'Name of Place',
            'Address',
            'Inclusive Travel Dates FROM',
            'Inclusive Travel Dates TO',
            'W ongoing COVID-19 transmission',

            'Social Gatherings',
            'Name of Place',
            'Address',
            'Inclusive Travel Dates FROM',
            'Inclusive Travel Dates TO',
            'W ongoing COVID-19 transmission',

            'Others',
            'Name of Place',
            'Address',
            'Inclusive Travel Dates FROM',
            'Inclusive Travel Dates TO',
            'W ongoing COVID-19 transmission',

            'Transport Service',
            'Transpo Name 1',
            'Transpo No 1',
            'Place of Origin 1',
            'Departure Date 1',
            'Destination 1',
            'Date of Arrival 1',

            'Transpo Name 2',
            'Transpo No 2',
            'Place of Origin 2',
            'Departure Date 2',
            'Destination 2',
            'Date of Arrival 2',

            'Name 1',
            'Contact Number 1',
            'Name 2',
            'Contact Number 2',
            'Name 3',
            'Contact Number 3',
            'Name 4',
            'Contact Number 4',

            'Attended',
            'for Hospitalization',
            'Patient ID',
            'MoLab Date Receipt',
        ];
    }
}
