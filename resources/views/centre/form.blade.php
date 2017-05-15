<div class="col-md-6">
    <div class="form-group row">
        {!! Form::label('did', 'DID', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('did', old('did') !== null ? old('did') : $centre->did, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('name', 'Name', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('name', old('name') !== null ? old('name') : $centre->name, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('nat_emis', 'Nat Emis', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('nat_emis', old('nat_emis') !== null ? old('nat_emis') : $centre->nat_emis, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('c_code', 'C Code', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('c_code', old('c_code') !== null ? old('c_code') : $centre->c_code, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('mobile_number', 'Mobile Number', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('mobile_number', old('mobile_number') !== null ? old('mobile_number') : $centre->mobile_number, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('landline_number', 'Landline Number', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('landline_number', old('landline_number') !== null ? old('landline_number') : $centre->landline_number, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('erf_number', 'Erf Number', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('erf_number', old('erf_number') !== null ? old('erf_number') : $centre->erf_number, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('registered_children_total', 'Registered total of children', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('registered_children_total', old('registered_children_total') !== null ? old('registered_children_total') : $centre->registered_children_total, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('registration_status', 'Registration Status', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('registration_status', ['Unregistered' => 'Unregistered', 'Registered' => 'Registered', 'Conditional' => 'Conditional'], old('registration_status') !== null ? old('registration_status') : $centre->registration_status, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('is_cf_registered', 'CF Registered', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('is_cf_registered', ['1' => 'Yes', '0' => 'No'], old('is_cf_registered') !== null ? old('is_cf_registered') : $centre->is_cf_registered, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('is_cf_partial_registered', 'CF Partial Registered', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('is_cf_partial_registered', ['1' => 'Yes', '0' => 'No'], old('is_cf_partial_registered') !== null ? old('is_cf_partial_registered') : $centre->is_cf_partial_registered, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('cf_certificate_expiry', 'CF Certificate Expiry', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            <div class="form-inline">
                {!! Form::date('cf_certificate_expiry', old('cf_certificate_expiry') !== null ? old('cf_certificate_expiry') : $centre->cf_certificate_expiry, ['class' => 'form-control date-pick-me']) !!}
            </div>
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('address_locality', 'Address Locality', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('address_locality', old('address_locality') !== null ? old('address_locality') : $centre->address_locality, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('address_region', 'Address Region', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('address_region', old('address_region') !== null ? old('address_region') : $centre->address_region, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('street_address', 'Street Address', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('street_address', old('street_address') !== null ? old('street_address') : $centre->street_address, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('address_country', 'Address Country', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('address_country', old('address_country') !== null ? old('address_country') : $centre->address_country, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('latitude', 'Latitude', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('latitude', old('latitude') !== null ? old('latitude') : $centre->latitude, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('longitude', 'Longitude', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('longitude', old('longitude') !== null ? old('longitude') : $centre->longitude, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('post_address_locality', 'Post Address Locality', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('post_address_locality', old('post_address_locality') !== null ? old('post_address_locality') : $centre->post_address_locality, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('post_address_region', 'Post Address Region', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('post_address_region', old('post_address_region') !== null ? old('post_address_region') : $centre->post_address_region, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('post_street_address', 'Post Street Address', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('post_street_address', old('post_street_address') !== null ? old('post_street_address') : $centre->post_street_address, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('post_office_box_number', 'Post Office Box Number', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('post_office_box_number', old('post_office_box_number') !== null ? old('post_office_box_number') : $centre->post_office_box_number, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('postal_code', 'Postal Code', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('postal_code', old('postal_code') !== null ? old('postal_code') : $centre->postal_code, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('post_address_country', 'Post Address Country', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('post_address_country', old('post_address_country') !== null ? old('post_address_country') : $centre->post_address_country, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('doe_status', 'DOE Status', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('doe_status', ['Open' => 'Open', 'Pending Closed' => 'Pending Closed', 'Closed' => 'Closed', 'Unknown' => 'Unknown'], old('doe_status') !== null ? old('doe_status') : $centre->doe_status, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('doe_type', 'DOE Type', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('doe_type', ['Early Childhood Development Centre' => 'Early Childhood Development Centre'], old('doe_type') !== null ? old('doe_type') : $centre->doe_type, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('sector', 'Sector', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('sector', ['Independant' => 'Independant', 'Public' => 'Public'], old('sector') !== null ? old('sector') : $centre->sector, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('doe_phase', 'DOE Phase', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('doe_phase', ['Pre-Primary School' => 'Pre-Primary School'], old('doe_phase') !== null ? old('doe_phase') : $centre->doe_phase, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('specialisation', 'Specialisation', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('specialisation', ['Early Childhood Basic Education' => 'Early Childhood Basic Education'], old('specialisation') !== null ? old('specialisation') : $centre->specialisation, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('owner_land', 'Owner Land', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('owner_land', ['Private' => 'Private', 'Public' => 'Public'], old('owner_land') !== null ? old('owner_land') : $centre->owner_land, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('owner_build', 'Owner Build', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('owner_build', ['Private' => 'Private', 'Public' => 'Public', 'Independent' => 'Independent', 'SOS Childrens Village' => 'SOS Childrens Village', 'State' => 'State', 'Unknown' => 'Unknown'], old('owner_build') !== null ? old('owner_build') : $centre->owner_build, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('paypoint_no', 'Paypoint No', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('paypoint_no', old('paypoint_no') !== null ? old('paypoint_no') : $centre->paypoint_no, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('component_no', 'Component No', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('component_no', old('component_no') !== null ? old('component_no') : $centre->component_no, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('magisterial_district', 'Magisterial District', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('magisterial_district', old('magisterial_district') !== null ? old('magisterial_district') : $centre->magisterial_district, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group row">
        {!! Form::label('district_municipality', 'District Municipality', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('district_municipality', old('district_municipality') !== null ? old('district_municipality') : $centre->district_municipality, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('local_municipality', 'Local Municipality', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('local_municipality', old('local_municipality') !== null ? old('local_municipality') : $centre->local_municipality, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('ward_id', 'Ward ID', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('ward_id', old('ward_id') !== null ? old('ward_id') : $centre->ward_id, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('el_region', 'EL Region', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('el_region', old('el_region') !== null ? old('el_region') : $centre->el_region, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('el_district', 'EL District', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('el_district', old('el_district') !== null ? old('el_district') : $centre->el_district, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('el_circuit', 'EL Circuit', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('el_circuit', old('el_circuit') !== null ? old('el_circuit') : $centre->el_circuit, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('facility_type', 'Type of Facility', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('facility_type', ['Creche' => 'Creche', 'After School Centre' => 'After School Centre', 'Educare/ECD' => 'Educare/ECD'], old('facility_type') !== null ? old('facility_type') : $centre->facility_type, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('contact_person', 'Contact Person', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('contact_person', old('contact_person') !== null ? old('contact_person') : $centre->contact_person, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('fax_number', 'Fax Number', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('fax_number', old('fax_number') !== null ? old('fax_number') : $centre->fax_number, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('email_address', 'Email address', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('email_address', old('email_address') !== null ? old('email_address') : $centre->email_address, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('operation_hours', 'Hours of operation', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('operation_hours', old('operation_hours') !== null ? old('operation_hours') : $centre->operation_hours, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('operation_days', 'Days of operation', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('operation_days', old('operation_days') !== null ? old('operation_days') : $centre->operation_days, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('npo_number', 'NPO number', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('npo_number', old('npo_number') !== null ? old('npo_number') : $centre->npo_number, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('children_enrolled', 'Enrolled number of children', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('children_enrolled', old('children_enrolled') !== null ? old('children_enrolled') : $centre->children_enrolled, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('min_age', 'Minimum Age', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('min_age', old('min_age') !== null ? old('min_age') : $centre->min_age, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('max_age', 'Maximum Age', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('max_age', old('max_age') !== null ? old('max_age') : $centre->max_age, ['class' => 'form-control']) !!}
        </div>
    </div>



    <div class="form-group row">
        {!! Form::label('last_facility_registration_date', 'Date of last facility registration', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            <div class="form-inline">
                {!! Form::text('last_facility_registration_date', old('last_facility_registration_date') !== null ? old('last_facility_registration_date') : $centre->last_facility_registration_date, ['class' => 'form-control date-pick-me']) !!}
            </div>
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('registration_lapses_date', 'Date on which registration lapses', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            <div class="form-inline">
                {!! Form::text('registration_lapses_date', old('registration_lapses_date') !== null ? old('registration_lapses_date') : $centre->registration_lapses_date, ['class' => 'form-control date-pick-me']) !!}
            </div>
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('ecd_programme_registration_date', 'Date of ECD programme registration', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            <div class="form-inline">
                {!! Form::text('ecd_programme_registration_date', old('ecd_programme_registration_date') !== null ? old('ecd_programme_registration_date') : $centre->ecd_programme_registration_date, ['class' => 'form-control date-pick-me']) !!}
            </div>
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('ecd_programme_laps_date', 'Date that ECD programme laps', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            <div class="form-inline">
                {!! Form::text('ecd_programme_laps_date', old('ecd_programme_laps_date') !== null ? old('ecd_programme_laps_date') : $centre->ecd_programme_laps_date, ['class' => 'form-control date-pick-me']) !!}
            </div>
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('funding_status', 'Funding status', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('funding_status', old('funding_status') !== null ? old('funding_status') : $centre->funding_status, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('qualifies_funding', 'Qualifies for funding', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('qualifies_funding', ['Yes' => 'Yes', 'No' => 'No'], old('qualifies_funding') !== null ? old('qualifies_funding') : $centre->qualifies_funding, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('number_of_staff', 'Number of staff', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('number_of_staff', old('number_of_staff') !== null ? old('number_of_staff') : $centre->number_of_staff, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('principal_qualification_level', 'Principal qualification level', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('principal_qualification_level', old('principal_qualification_level') !== null ? old('principal_qualification_level') : $centre->principal_qualification_level, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('staff_qualification_levels', 'Staff qualification levels', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('staff_qualification_levels', old('staff_qualification_levels') !== null ? old('staff_qualification_levels') : $centre->staff_qualification_levels, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('ecd_programme_registration_type', 'Type of ECD Programme registration', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::select('ecd_programme_registration_type', ['NCF - Grassroots site learning' => 'NCF - Grassroots site learning', 'NCF - ELRU' => 'NCF - ELRU', 'Masikhule' => 'Masikhule', 'Early Years' => 'Early Years', 'TEEC' => 'TEEC', 'Learn 2 Live' => 'Learn 2 Live'], old('ecd_programme_registration_type') !== null ? old('ecd_programme_registration_type') : $centre->ecd_programme_registration_type, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('regional_office', 'Regional office', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('regional_office', old('regional_office') !== null ? old('regional_office') : $centre->regional_office, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('service_delivery', 'Service Delivery', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('service_delivery', old('service_delivery') !== null ? old('service_delivery') : $centre->service_delivery, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('area_municipality', 'Area Municipality', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('area_municipality', old('area_municipality') !== null ? old('area_municipality') : $centre->area_municipality, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('main_place', 'Main Place', ['class' => 'col-md-5 col-form-label']); !!}
        <div class="col-md-7">
            {!! Form::text('main_place', old('main_place') !== null ? old('main_place') : $centre->main_place, ['class' => 'form-control']) !!}
        </div>
    </div>

</div>
