 Project Structure for SkillBridge (PHP + MySQL + Bootstrap)
 📁 skillbridge
 .
├── addcompany.php
├── adduser.php
├── admin
│   ├── active-jobs.php
│   ├── applications.php
│   ├── approve-company.php
│   ├── checklogin.php
│   ├── companies.php
│   ├── dashboard.php
│   ├── delete-company.php
│   ├── delete-job-post.php
│   ├── index.php
│   ├── reject-company.php
│   └── view-job-post.php
├── apply.php
├── assets
│   └── images
│       ├── africa-map-hero.png
│       ├── african-pattern-bg.jpg
│       ├── african-texture.jpg
│       └── empty-services.svg
├── checkcompanylogin.php
├── checklogin.php
├── city.php
├── company
│   ├── add-mail.php
│   ├── addpost.php
│   ├── change-password.php
│   ├── create-job-post.php
│   ├── create-mail.php
│   ├── deactivate-account.php
│   ├── edit-company.php
│   ├── index.php
│   ├── job-applications.php
│   ├── mailbox.php
│   ├── my-job-post.php
│   ├── read-mail.php
│   ├── reject.php
│   ├── reply-mailbox.php
│   ├── resume-database.php
│   ├── settings.php
│   ├── under-review.php
│   ├── update-company.php
│   ├── update-name.php
│   ├── user-application.php
│   └── view-job-post.php
├── css
│   ├── AdminLTE.min.css
│   ├── _all-skins.min.css
│   └── custom.css
├── database
│   ├── db.php
│   └── install.sql
├── database.sql
├── db.php
├── img
│   ├── boxed-bg.jpg
│   ├── boxed-bg.png
│   ├── browse.jpg
│   ├── career.jpg
│   ├── default-50x50.gif
│   ├── hire.png
│   ├── icons.png
│   ├── interviewed.jpeg
│   ├── job-search.jpg
│   ├── manage.jpg
│   ├── photo1.png
│   └── postjob.png
├── includes
│   ├── authentication.php
│   ├── chat_functions.php
│   ├── config.php
│   ├── footer.php
│   └── header.php
├── index.php
├── jobpagination.php
├── jobs.php
├── js
│   ├── adminlte.min.js
│   ├── jquery.twbsPagination.min.js
│   └── tinymce
│       ├── jquery.tinymce.min.js
│       ├── langs
│       │   └── readme.md
│       ├── license.txt
│       ├── plugins
│       │   ├── advlist
│       │   │   └── plugin.min.js
│       │   ├── anchor
│       │   │   └── plugin.min.js
│       │   ├── autolink
│       │   │   └── plugin.min.js
│       │   ├── autoresize
│       │   │   └── plugin.min.js
│       │   ├── autosave
│       │   │   └── plugin.min.js
│       │   ├── bbcode
│       │   │   └── plugin.min.js
│       │   ├── charmap
│       │   │   └── plugin.min.js
│       │   ├── code
│       │   │   └── plugin.min.js
│       │   ├── codesample
│       │   │   ├── css
│       │   │   │   └── prism.css
│       │   │   └── plugin.min.js
│       │   ├── colorpicker
│       │   │   └── plugin.min.js
│       │   ├── contextmenu
│       │   │   └── plugin.min.js
│       │   ├── directionality
│       │   │   └── plugin.min.js
│       │   ├── emoticons
│       │   │   ├── img
│       │   │   │   ├── smiley-cool.gif
│       │   │   │   ├── smiley-cry.gif
│       │   │   │   ├── smiley-embarassed.gif
│       │   │   │   ├── smiley-foot-in-mouth.gif
│       │   │   │   ├── smiley-frown.gif
│       │   │   │   ├── smiley-innocent.gif
│       │   │   │   ├── smiley-kiss.gif
│       │   │   │   ├── smiley-laughing.gif
│       │   │   │   ├── smiley-money-mouth.gif
│       │   │   │   ├── smiley-sealed.gif
│       │   │   │   ├── smiley-smile.gif
│       │   │   │   ├── smiley-surprised.gif
│       │   │   │   ├── smiley-tongue-out.gif
│       │   │   │   ├── smiley-undecided.gif
│       │   │   │   ├── smiley-wink.gif
│       │   │   │   └── smiley-yell.gif
│       │   │   └── plugin.min.js
│       │   ├── fullpage
│       │   │   └── plugin.min.js
│       │   ├── fullscreen
│       │   │   └── plugin.min.js
│       │   ├── help
│       │   │   ├── img
│       │   │   │   └── logo.png
│       │   │   └── plugin.min.js
│       │   ├── hr
│       │   │   └── plugin.min.js
│       │   ├── image
│       │   │   └── plugin.min.js
│       │   ├── imagetools
│       │   │   └── plugin.min.js
│       │   ├── importcss
│       │   │   └── plugin.min.js
│       │   ├── insertdatetime
│       │   │   └── plugin.min.js
│       │   ├── legacyoutput
│       │   │   └── plugin.min.js
│       │   ├── link
│       │   │   └── plugin.min.js
│       │   ├── lists
│       │   │   └── plugin.min.js
│       │   ├── media
│       │   │   └── plugin.min.js
│       │   ├── nonbreaking
│       │   │   └── plugin.min.js
│       │   ├── noneditable
│       │   │   └── plugin.min.js
│       │   ├── pagebreak
│       │   │   └── plugin.min.js
│       │   ├── paste
│       │   │   └── plugin.min.js
│       │   ├── preview
│       │   │   └── plugin.min.js
│       │   ├── print
│       │   │   └── plugin.min.js
│       │   ├── save
│       │   │   └── plugin.min.js
│       │   ├── searchreplace
│       │   │   └── plugin.min.js
│       │   ├── spellchecker
│       │   │   └── plugin.min.js
│       │   ├── tabfocus
│       │   │   └── plugin.min.js
│       │   ├── table
│       │   │   └── plugin.min.js
│       │   ├── template
│       │   │   └── plugin.min.js
│       │   ├── textcolor
│       │   │   └── plugin.min.js
│       │   ├── textpattern
│       │   │   └── plugin.min.js
│       │   ├── toc
│       │   │   └── plugin.min.js
│       │   ├── visualblocks
│       │   │   ├── css
│       │   │   │   └── visualblocks.css
│       │   │   └── plugin.min.js
│       │   ├── visualchars
│       │   │   └── plugin.min.js
│       │   └── wordcount
│       │       └── plugin.min.js
│       ├── skins
│       │   └── lightgray
│       │       ├── content.inline.min.css
│       │       ├── content.min.css
│       │       ├── fonts
│       │       │   ├── tinymce.eot
│       │       │   ├── tinymce-small.eot
│       │       │   ├── tinymce-small.svg
│       │       │   ├── tinymce-small.ttf
│       │       │   ├── tinymce-small.woff
│       │       │   ├── tinymce.svg
│       │       │   ├── tinymce.ttf
│       │       │   └── tinymce.woff
│       │       ├── img
│       │       │   ├── anchor.gif
│       │       │   ├── loader.gif
│       │       │   ├── object.gif
│       │       │   └── trans.gif
│       │       └── skin.min.css
│       ├── themes
│       │   ├── inlite
│       │   │   └── theme.min.js
│       │   └── modern
│       │       └── theme.min.js
│       └── tinymce.min.js
├── login-candidates.php
├── login-company.php
├── login.php
├── logout.php
├── public
│   ├── contact.php
│   ├── index.php
│   ├── login-candidates.php
│   ├── login-company.php
│   ├── login.php
│   ├── logout.php
│   ├── register.php
│   ├── service-details.php
│   ├── services.php
│   └── sign-up.php
├── README.md
├── register-candidates.php
├── register-company.php
├── search.php
├── sign-up.php
├── skillbridge-payments
│   ├── callback
│   │   └── mpesa_callback.php
│   ├── config
│   │   ├── config.php
│   │   └── db.php
│   ├── includes
│   │   ├── mpesa_functions.php
│   │   └── tax_functions.php
│   ├── index.php
│   ├── mysql.sql
│   └── payments
│       ├── initiate_payment.php
│       └── payment_history.php
├── state.php
├── uploads
│   └── logo
│       ├── 59cd0fd60ae8b.png
│       ├── 59d275f598789.png
│       ├── 59d2781509663.png
│       └── 59d278273078a.png
├── user
│   ├── add-mail.php
│   ├── change-password.php
│   ├── create-mail.php
│   ├── deactivate-account.php
│   ├── edit-profile.php
│   ├── index.php
│   ├── mailbox.php
│   ├── read-mail.php
│   ├── reply-mailbox.php
│   ├── settings.php
│   ├── update-profile.php
│   └── view-job-post.php
└── view-job-post.php

Website Testing

Download the latest database.sql file.

There are 100 candidate users, 100 companies account & 1 admin account. There are 100 dummy job posts added by random companies.

Step 1: Create a database called jobportal and import everything from database.sql file. Next check your db.php file for database connection configuration

//Your db.php Mysql Config
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobportal";

Step2: Now you login as candidate with following details

Email: oleg@test.com
Password: 123456
//Note1: There are 100 candadates users all with same password-123456
//Note2: All Password are encrpyted through code so you CANNOT change password directly from database.

Step3: Now you login as Company with following details

Email: lobortis@a.ca
Password: 123456
//Note1: There are 100 Companies account all with same password-123456
//Note2: All Password are encrpyted through code so you CANNOT change password directly from database.

Step4: Now you login as Admin with following details

Username: admin
Password: 123456
//Note: Password is not encrpyted from code so you CAN change directly from database.

Candidates Email Confirmation:

    You CANNOT send emails from localhost server. So when you create a new candidate account it will not send any emails. So you must go to database, find that user and set active=1 in order to make that account login.

    If you are testing on real server then you can uncomment the following code from adduser.php

// Send Email
$to = {CANDIDATE_EMAIL ADDRESS};
$subject = "Job Portal - Confirm Your Email Address";
$message = '
    <html>
    	 <head>
		    <title>Confirm Your Email</title>
		</head>
		<body>
		    <p>Click Link To Confirm</p>
		    <a href="{YOUR_REAL_DOMAIL}/verify.php?token='.$hash.'&email='.$email.'">Verify Email</a>
		</body>
	</html>
';
$headers[] = 'MIME-VERSION: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';
$headers[] = 'To: '.$to;
$headers[] = 'From: hello@yourdomain.com';
// You can add more headers like Cc, Bcc;
$result = mail($to, $subject, $message, implode("\r\n", $headers)); // \r\n will return new line. 
if($result === TRUE) {
//If email sent successfully then Set some session variables and redirect to login page
	$_SESSION['registerCompleted'] = true;
	header("Location: login.php");
	exit();
}