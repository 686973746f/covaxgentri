@extends('layouts.app')

@section('content')
    <form action="{{route('vaccination_register_store')}}"  method="POST" autocapitalize="characters" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="container" style="font-family: Arial, Helvetica, sans-serif;">
            <div class="card border-success">
                <div class="card-header bg-success text-white"><strong>Register</strong></div>
                <div class="card-body">
                    @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <p>{{Str::plural('Error', $errors->count())}} detected while creating the CIF of the Patient:</p>
                        <hr>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </div>
                    @endif
                    <div class="alert alert-info" role="alert">
                        <strong>Note:</strong> All Fields marked with an asterisk (<span class="text-danger"><strong>*</strong></span>) are required. We enjoin you to provide only true and accurate information to avoid the penalties as provided in the law.
                    </div>
                    <div class="card mb-3">
                        <div class="card-header"><strong>I. Vaccination Details</strong></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="priority_group" class="form-label">Priority Group</label>
                                        <select class="form-select" name="priority_group" id="priority_group">
                                            <option value="" disabled {{is_null(old('priority_group')) ? 'selected' : ''}}>Choose...</option>
                                            <option value="A1">A1 (Healthcare Workers)</option>
                                            <option value="A2">A2 (Senior Citizens, 60 Years Old Pataas)</option>
                                            <option value="A3">A3 (Persons with Comorbidity)</option>
                                            <option value="A4">A4 (Essential Workers)</option>
                                            <option value="A5">A5 (Indigent Population)</option>
                                            <option value="ROAP">SHS/College Students (ROAP)</option>
                                            <option value="ROPP">Pediatric: Children (ROPP)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="is_pwd" class="form-label">Are you a Person With Disability?</label>
                                        <select class="form-select" name="is_pwd" id="is_pwd">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="is_indigenous" class="form-label">Are you an Indigent?</label>
                                        <select class="form-select" name="is_indigenous" id="is_indigenous">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="part1div" class="d-none">
                        <div class="card mb-3">
                            <div class="card-header"><strong>II. Personal Information</strong></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="lname" class="form-label"><span class="text-danger font-weight-bold">*</span>Last Name</label>
                                            <input type="text" class="form-control" name="lname" id="lname" value="{{old('lname')}}" maxlength="50" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="fname" class="form-label"><span class="text-danger font-weight-bold">*</span>First Name</label>
                                            <input type="text" class="form-control" name="fname" id="fname" value="{{old('fname')}}" maxlength="50" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="mname" class="form-label">Middle Name <i><small>(If Applicable)</small></i></label>
                                            <input type="text" class="form-control" name="mname" id="mname" value="{{old('mname')}}" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="suffix" class="form-label">Suffix <i><small>(If Applicable)</small></i></label>
                                            <input type="text" class="form-control" name="suffix" id="suffix" value="{{old('suffix')}}" maxlength="3" placeholder="e.g JR, SR, III, IV">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                          <label for="bdate" class="form-label"><span class="text-danger font-weight-bold">*</span>Birthdate</label>
                                          <input type="date" class="form-control" name="bdate" id="bdate" value="{{old('bdate')}}" min="1900-01-01" max="{{date('Y-m-d', strtotime('yesterday'))}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="sex" class="form-label"><span class="text-danger font-weight-bold">*</span>Gender</label>
                                            <select class="form-select" name="sex" id="sex" required>
                                                <option value="" disabled {{(is_null(old('sex'))) ? 'selected' : ''}}>Choose...</option>
                                                <option value="MALE" {{(old('sex') == 'MALE') ? 'selected' : ''}}>Male</option>
                                                <option value="FEMALE" {{(old('sex') == 'FEMALE') ? 'selected' : ''}}>Female</option>
                                            </select>
                                        </div>
                                        <div id="if_female" class="d-none">
                                            <div class="mb-3">
                                                <label for="if_female_pregnant" class="form-label"><span class="text-danger font-weight-bold">*</span>Are you Pregnant?</label>
                                                <select class="form-select" name="if_female_pregnant" id="if_female_pregnant">
                                                    <option value="" disabled {{(is_null(old('if_female_pregnant'))) ? 'selected' : ''}}>Choose...</option>
                                                    <option value="0" {{(old('if_female_pregnant') == 0) ? 'selected' : ''}}>No</option>
                                                    <option value="1" {{(old('if_female_pregnant') == 1) ? 'selected' : ''}}>Yes</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="if_female_lactating" class="form-label"><span class="text-danger font-weight-bold">*</span>Lactating?</label>
                                                <select class="form-select" name="if_female_lactating" id="if_female_lactating">
                                                  <option value="" disabled {{(is_null(old('if_female_lactating'))) ? 'selected' : ''}}>Choose...</option>
                                                  <option value="0" {{(old('if_female_lactating') == 0) ? 'selected' : ''}}>No</option>
                                                  <option value="1" {{(old('if_female_lactating') == 1) ? 'selected' : ''}}>Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="cs" class="form-label"><span class="text-danger font-weight-bold">*</span>Civil Status</label>
                                            <select class="form-select" id="cs" name="cs" required>
                                                <option value="" disabled {{(is_null(old('cs'))) ? 'selected' : ''}}>Choose...</option>
                                                <option value="SINGLE" {{(old('cs') == 'SINGLE') ? 'selected' : ''}}>Single</option>
                                                <option value="MARRIED" {{(old('cs') == 'MARRIED') ? 'selected' : ''}}>Married</option>
                                                <option value="WIDOWED" {{(old('cs') == 'WIDOWED') ? 'selected' : ''}}>Widowed</option>
                                                <option value="N/A" {{(old('cs') == 'N/A') ? 'selected' : ''}}>N/A</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="nationality" class="form-label"><span class="text-danger font-weight-bold">*</span>Nationality</label>
                                            <select class="form-select" id="nationality" name="nationality" required>
                                                <option value="Filipino" {{(old('nationality') == 'Filipino') ? 'selected' : ''}}>Filipino</option>
                                                <option value="Foreign" {{(old('nationality') == 'Foreign') ? 'selected' : ''}}>Foreign</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="contactno" class="form-label"><span class="text-danger font-weight-bold">*</span>Contact Number (Mobile)</label>
                                            <input type="text" class="form-control" id="contactno" name="contactno" value="{{old('contactno', '09')}}" pattern="[0-9]{11}" placeholder="09xxxxxxxxx" required>
                                            <small class="text-muted">Paki-lagay ang iyong kasalukuyang aktibong mobile number upang ma-kontak ka ng aming mga staff.</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email Address <i><small>(If Applicable)</small></i></label>
                                            <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="philhealth" class="form-label">Philhealth Number <i><small>(If Applicable)</small></i></label>
                                            <input type="text" class="form-control" id="philhealth" name="philhealth" value="{{old('philhealth')}}" pattern="[0-9]{12}">
                                            <small class="text-muted">Note: Input the Complete Philhealth Number (12 Digits, No Dashes)</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="guardian_div" class="d-none">
                            <div class="card mb-3">
                                <div class="card-header"><strong>2.1 Guardian Details</strong></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="ifpedia_guardian_lname" class="form-label"><span class="text-danger font-weight-bold">*</span>Guardian Last Name</label>
                                                <input type="text" class="form-control" name="ifpedia_guardian_lname" id="ifpedia_guardian_lname" value="{{old('ifpedia_guardian_lname')}}" maxlength="50">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="ifpedia_guardian_fname" class="form-label"><span class="text-danger font-weight-bold">*</span>Guardian First Name</label>
                                                <input type="text" class="form-control" name="ifpedia_guardian_fname" id="ifpedia_guardian_fname" value="{{old('ifpedia_guardian_fname')}}" maxlength="50">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="ifpedia_guardian_mname" class="form-label">Guardian Middle Name <i><small>(If Applicable)</small></i></label>
                                                <input type="text" class="form-control" name="ifpedia_guardian_mname" id="ifpedia_guardian_mname" value="{{old('ifpedia_guardian_mname')}}" maxlength="50">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="ifpedia_guardian_suffix" class="form-label">Guardian Suffix <i><small>(If Applicable)</small></i></label>
                                                <input type="text" class="form-control" name="ifpedia_guardian_suffix" id="ifpedia_guardian_suffix" value="{{old('ifpedia_guardian_suffix')}}" maxlength="3" placeholder="e.g JR, SR, III, IV">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <label for="ifpedia_requirements" class="form-label"><span class="text-danger font-weight-bold">*</span>Upload Valid ID of Guardian</label>
                                        <input class="form-control" type="file" id="ifpedia_requirements" name="ifpedia_requirements">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header"><strong>III. Current Address</strong></div>
                            <div class="card-body">
                                <div id="address_text" class="d-none">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" id="address_region_text" name="address_region_text" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" id="address_province_text" name="address_province_text" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" id="address_muncity_text" name="address_muncity_text" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                          <label for="address_region_code" class="form-label"><span class="text-danger font-weight-bold">*</span>Region</label>
                                          <select class="form-select" name="address_region_code" id="address_region_code" required>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address_province_code" class="form-label"><span class="text-danger font-weight-bold">*</span>Province</label>
                                            <select class="form-select" name="address_province_code" id="address_province_code" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address_muncity_code" class="form-label"><span class="text-danger font-weight-bold">*</span>City/Municipality</label>
                                            <select class="form-select" name="address_muncity_code" id="address_muncity_code" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address_brgy_text" class="form-label"><span class="text-danger font-weight-bold">*</span>Barangay</label>
                                            <select class="form-select" name="address_brgy_text" id="address_brgy_text" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address_houseno" class="form-label"><span class="text-danger font-weight-bold">*</span>House No./Lot/Building</label>
                                            <input type="text" class="form-control" id="address_houseno" name="address_houseno" style="text-transform: uppercase;" value="{{old('address_houseno')}}" pattern="(^[a-zA-Z0-9 ]+$)+" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address_street" class="form-label"><span class="text-danger font-weight-bold">*</span>Street/Subdivision/Purok/Sitio</label>
                                            <input type="text" class="form-control" id="address_street" name="address_street" style="text-transform: uppercase;" value="{{old('address_street')}}" pattern="(^[a-zA-Z0-9 ]+$)+" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header"><strong>IV. Medical Information</strong></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="comorbid_list" class="form-label">Do you have Comorbidities? <small><i>(Select all that apply)</i></small></label>
                                    <select class="form-select" name="comorbid_list[]" id="comorbid_list" multiple>
                                        <option value="Hypertension">Hypertension</option>
                                        <option value="Diabetes">Diabetes</option>
                                        <option value="Heart Disease">Heart Disease</option>
                                        <option value="Lung Disease">Lung Disease</option>
                                        <option value="Gastrointestinal">Gastrointestinal</option>
                                        <option value="Genito-urinary">Genito-urinary</option>
                                        <option value="Neurological Disease">Neurological Disease</option>
                                        <option value="Cancer">Cancer</option>
                                        <option value="Others">Others, specify</option>
                                    </select>
                                </div>
                                <div id="como_others" class="d-none">
                                    <div class="mb-3">
                                        <label for="comorbid_others" class="form-label">Other Comorbidities, please specify</label>
                                        <input type="text" class="form-control" name="comorbid_others" id="comorbid_others">
                                    </div>
                                </div>
                                <div class="">
                                  <label for="allergy_list" class="form-label">Allergies <small><i>(If Applicable)</i></small></label>
                                  <input type="text" class="form-control" name="allergy_list" id="allergy_list">
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header"><strong>V. Vaccination Account</strong></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="username" class="form-label"><span class="text-danger font-weight-bold">*</span>Username</label>
                                            <input type="text" class="form-control" name="username" id="username" maxlength="30" value="{{old('username')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="password" class="form-label"><span class="text-danger font-weight-bold">*</span>Password</label>
                                            <input type="password" class="form-control" name="password" id="password" maxlength="30">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label"><span class="text-danger font-weight-bold">*</span>Repeat Password</label>
                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" maxlength="30">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="requirement_id_filepath" class="form-label"><span class="text-danger font-weight-bold">*</span>Upload Valid ID of Patient</label>
                                            <input class="form-control" type="file" id="requirement_id_filepath" name="requirement_id_filepath" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="requirement_selfie" class="form-label"><span class="text-danger font-weight-bold">*</span>Upload Selfie of Patient</label>
                                            <input class="form-control" type="file" id="requirement_selfie" name="requirement_selfie" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>        
                        <div class="card">
                            <div class="card-header"><strong>Data Privacy Statement of General Trias</strong></div>
                            <div class="card-body">
                                <p class="text-center">By choosing "I Agree" and clicking the "Submit" button below, I hereby acknowledge and certify that I have carefully read and understood the Terms and Conditions of the Data Privacy Policy/Notice of the City Government of General Trias. By providing personal information to City Government of General Trias, I am confirming that the data is true and correct. I understand that City Government of General Trias reserves the right to revise any decision made on the basis of the information I provided should the information be found to be untrue or incorrect. I likewise agree that any issue that may arise in connection with the processing of my personal information will be settled amicably with City Government of General Trias before resorting to appropriate arbitration or court proceedings within the Philippine jurisdiction. Finally, I am providing my voluntary consent and authorization to City Government of General Trias and its authorized representatives to lawfully process my data/information.</p>
                                <div class="form-check text-center">
                                    <label class="form-check-label" class="form-label">
                                      <input type="checkbox" class="form-check-input" name="dpsagree" id="dpsagree" required> I Agree
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary" id="submitbtn">Submit</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        $('#priority_group').change(function (e) { 
            e.preventDefault();
            if($(this).val() == 'ROPP') {
                $('#guardian_div').removeClass('d-none');
                $('#ifpedia_guardian_fname').prop('required', true);
                $('#ifpedia_guardian_lname').prop('required', true);
                $('#ifpedia_requirements').prop('required', true);
            }
            else {
                $('#guardian_div').addClass('d-none');
                $('#ifpedia_guardian_fname').prop('required', false);
                $('#ifpedia_guardian_lname').prop('required', false);
                $('#ifpedia_requirements').prop('required', false);
            }
        });
        
        $("#comorbid_list").change(function () {
            if ($("#comorbid_list option[value=Others]:selected").length > 0) {
                $('#como_others').removeClass('d-none');
                $('#comorbid_others').prop('required', true);
            }
            else {
                $('#como_others').addClass('d-none');
                $('#comorbid_others').prop('required', false);
            }
        });

        //Region Select Initialize
        $.getJSON("{{asset('json/refregion.json')}}", function(data) {
			var sorted = data.sort(function(a, b) {
				if (a.regDesc > b.regDesc) {
				    return 1;
				}
				if (a.regDesc < b.regDesc) {
				    return -1;
				}

				return 0;
			});

			$.each(sorted, function(key, val) {
				$('#address_region_code').append($('<option>', {
					value: val.regCode,
					text: val.regDesc,
					selected: (val.regCode == '04') ? true : false, //default is Region IV-A
				}));
			});
        });

        $('#address_region_code').change(function (e) { 
            e.preventDefault();
            //Empty and Disable
            $('#address_province_code').empty();
            $("#address_province_code").append('<option value="" selected disabled>Choose...</option>');

            $('#address_muncity_code').empty();
            $("#address_muncity_code").append('<option value="" selected disabled>Choose...</option>');

            //Re-disable Select
            $('#address_muncity_code').prop('disabled', true);
            $('#address_brgy_text').prop('disabled', true);

            //Set Values for Hidden Box
            $('#address_region_text').val($('#address_region_code option:selected').text());

            $.getJSON("{{asset('json/refprovince.json')}}", function(data) {
                var sorted = data.sort(function(a, b) {
                    if (a.provDesc > b.provDesc) {
                    return 1;
                    }
                    if (a.provDesc < b.provDesc) {
                    return -1;
                    }
                    return 0;
                });

                $.each(sorted, function(key, val) {
                    if($('#address_region_code').val() == val.regCode) {
                        $('#address_province_code').append($('<option>', {
                            value: val.provCode,
                            text: val.provDesc,
                            selected: (val.provCode == '0421') ? true : false, //default for Cavite
                        }));
                    }
                });
            });
        }).trigger('change');

        $('#address_province_code').change(function (e) {
			e.preventDefault();
            //Empty and Disable
            $('#address_muncity_code').empty();
            $("#address_muncity_code").append('<option value="" selected disabled>Choose...</option>');

            //Re-disable Select
            $('#address_muncity_code').prop('disabled', false);
            $('#address_brgy_text').prop('disabled', true);

            //Set Values for Hidden Box
            $('#address_province_text').val($('#address_province_code option:selected').text());

			$.getJSON("{{asset('json/refcitymun.json')}}", function(data) {
				var sorted = data.sort(function(a, b) {
					if (a.citymunDesc > b.citymunDesc) {
					    return 1;
					}
					if (a.citymunDesc < b.citymunDesc) {
					    return -1;
					}
					return 0;
				});
				$.each(sorted, function(key, val) {
					if($('#address_province_code').val() == val.provCode) {
						$('#address_muncity_code').append($('<option>', {
							value: val.citymunCode,
							text: val.citymunDesc,
							selected: (val.citymunCode == '042108') ? true : false, //default for General Trias
						})); 
					}
				});
			});
		}).trigger('change');

        $('#address_muncity_code').change(function (e) {
			e.preventDefault();
            //Empty and Disable
            $('#address_brgy_text').empty();
            $("#address_brgy_text").append('<option value="" selected disabled>Choose...</option>');

            //Re-disable Select
            $('#address_muncity_code').prop('disabled', false);
            $('#address_brgy_text').prop('disabled', false);

            //Set Values for Hidden Box
            $('#address_muncity_text').val($('#address_muncity_code option:selected').text());

			$.getJSON("{{asset('json/refbrgy.json')}}", function(data) {
				var sorted = data.sort(function(a, b) {
					if (a.brgyDesc > b.brgyDesc) {
					return 1;
					}
					if (a.brgyDesc < b.brgyDesc) {
					return -1;
					}
					return 0;
				});
				$.each(sorted, function(key, val) {
					if($('#address_muncity_code').val() == val.citymunCode) {
                        $('#address_brgy_text').append($('<option>', {
							value: val.brgyDesc.toUpperCase(),
							text: val.brgyDesc.toUpperCase(),
						}));
					}
				});
			});
		}).trigger('change');

        $('#address_region_text').val('REGION IV-A (CALABARZON)');
        $('#address_province_text').val('CAVITE');
        $('#address_muncity_text').val('GENERAL TRIAS');
        
        $('#priority_group').change(function (e) { 
            if($(this).val() == null) {
                $('#part1div').addClass('d-none');
                $('#submitbtn').prop('disabled', true);
            }
            else {
                $('#part1div').removeClass('d-none');
                $('#submitbtn').prop('disabled', false);
            }
        }).trigger('change');

        $('#sex').change(function (e) { 
            e.preventDefault();
            if($(this).val() == null || $(this).val() == 'MALE') {
                $('#if_female').addClass('d-none');
                $('#if_female_pregnant').prop('required', false);
                $('#if_female_lactating').prop('required', false);
            }
            else if($(this).val() == 'FEMALE') {
                $('#if_female').removeClass('d-none');
                $('#if_female_pregnant').prop('required', true);
                $('#if_female_lactating').prop('required', true);
            }
        }).trigger('change');
    </script>
@endsection