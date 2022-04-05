@extends('layouts.app')

@section('content')
    <form action="{{route('vaccination_register_store')}}" method="POST" autocapitalize="characters" autocomplete="off">
        <div class="container">
            <div class="card">
                <div class="card-header"><strong>Register</strong></div>
                <div class="card-body">
                    <div class="alert alert-info" role="alert">
                        <strong>Note:</strong> All Fields marked with an asterisk (<span class="text-danger"><strong>*</strong></span>) are required.
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="priority_group" class="form-label">Priority Group</label>
                                <select class="form-select" name="priority_group" id="priority_group">
                                    <option value="" disabled {{is_null(old('priority_group')) ? 'selected' : ''}}>Choose...</option>
                                    <option value="A1">A1</option>
                                    <option value="A2">A2</option>
                                    <option value="A3">A3</option>
                                    <option value="A4">A4</option>
                                    <option value="A5">A5</option>
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
                    <div id="part1div" class="d-none">
                        <hr>
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
                                    <input type="text" class="form-control" name="mname" id="mname" value="{{old('mname')}}" maxlength="50" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="suffix" class="form-label">Suffix <i><small>(If Applicable)</small></i></label>
                                    <input type="text" class="form-control" name="suffix" id="suffix" value="{{old('suffix')}}" maxlength="3" placeholder="e.g JR, SR, III, IV" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                  <label for="bdate" class="form-label"><span class="text-danger font-weight-bold">*</span>Birthdate</label>
                                  <input type="date" class="form-control" name="bdate" id="bdate" min="1900-01-01" max="{{date('Y-m-d', strtotime('yesterday'))}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="sex" class="form-label"><span class="text-danger font-weight-bold">*</span>Gender</label>
                                    <select class="form-control" name="sex" id="sex" required>
                                        <option value="" disabled {{(is_null(old('sex'))) ? 'selected' : ''}}>Choose...</option>
                                        <option value="MALE" {{(old('sex') == 'MALE') ? 'selected' : ''}}>Male</option>
                                        <option value="FEMALE" {{(old('sex') == 'FEMALE') ? 'selected' : ''}}>Female</option>
                                    </select>
                                </div>
                                <div id="if_female" class="d-none">
                                    <div class="mb-3">
                                        <label for="if_female_pregnant" class="form-label"><span class="text-danger font-weight-bold">*</span>Are you Pregnant?</label>
                                        <select class="form-control" name="if_female_pregnant" id="if_female_pregnant">
                                            <option value="" disabled {{(is_null(old('if_female_pregnant'))) ? 'selected' : ''}}>Choose...</option>
                                            <option value="0" {{(old('if_female_pregnant') == 0) ? 'selected' : ''}}>No</option>
                                            <option value="1" {{(old('if_female_pregnant') == 1) ? 'selected' : ''}}>Yes</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="if_female_lactating" class="form-label"><span class="text-danger font-weight-bold">*</span>Lactating?</label>
                                        <select class="form-control" name="if_female_lactating" id="if_female_lactating">
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
                                    <select class="form-control" id="cs" name="cs" required>
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
                                    <select class="form-control" id="nationality" name="nationality" required>
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
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                  <label for="" class="form-label"></label>
                                  <select class="form-select" name="" id="">
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">

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
                        <hr>
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
                                    <label for="password1" class="form-label"><span class="text-danger font-weight-bold">*</span>Repeat Password</label>
                                    <input type="password" class="form-control" name="password1" id="password1" maxlength="30">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header text-center">Data Privacy Statement of General Trias</div>
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