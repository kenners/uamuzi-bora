<h1>New Patient</h1>
<?php

// Begin the form
echo '<form action="/index.php/patients/add" method="post">' . "\n";

// patients.upn
echo $form->input('upn');

// patients.surname
echo $form->input('surname');

// patients.forenames
echo $form->input('forenames');

// patients.date_of_birth
echo $form->input('date_of_birth');

// patients.sex
echo 'Sex' . $form->select('sex', array('Unknown', 'Male', 'Female'), 'Unknown');

// patients.mother
echo $form->input('mother');

// patients.occupation_id
echo $form->input('occupation_id');

// patients.education_id
echo $form->input('education_id');

// patients.marital_status_id
echo $form->input('marital_status_id');

// patients.telephone_number
echo $form->input('telphone_number');

// patients.location_id
echo $form->input('location_id');

// patients.vilage
echo $form->input('village');

// patients.home
echo $form->input('home');

// patients.nearest_church
echo $form->input('nearest_church');

// patients.nearest_school
echo $form->input('nearest_school');

// patients.nearest_health_centre
echo $form->input('nearest_health_centre');

// patients.nearest_major_landmark
echo $form->input('nearest_major_landmark');

// End the form
echo '<input type="submit" value="Add patient" />' . "\n";

?>
