<?php require_once 'defines.inc.php'?>
<?php

	if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]))
	{
		header("Location: " . HTTP . "?error=404");
		exit();
	}

	$description = "Typed helps you discover what people think about your life and helps people talk with you anonymously. Join our Crushbox or answer your fans' questions here or on your favorite Social Network!";
	$short = "Typed, where you can reveal who you are";

	$empty = "Fill all required fields";
	$conn = "Error connecting to the server. Try again";
	$unknown = "Unknown error. Try again";
	$show = "Show";
	$here = "here";

	$validity = "The username must contain between 3 and 30 characters and start with a letter. Valid characters: A-Z 0-9 . _";

	$times = [
		'y' => [
			"year",
			"years"
		],
		'm' => [
			"month",
			"months"
		],
		'd' => [
			"day",
			"days"
		],
		'h' => [
			"hour",
			"hours"
		],
		'i' => [
			"minute",
			"minutes"
		],
		's' => [
			"second",
			"seconds"
		],

		'now' => "Now",

		'ago' => [
			"",
			"ago"
		]
	];

	$header = [
		'alt1' => "Search",

		'alt2' => "Scroll",

		'back' => "Back",

		'search' => "Search for a page or a user",

		'theme' => "Theme",

		'personal' => "Personal",

		'light' => "Light",

		'dark' => "Dark",

		'random' => "Random",

		'personalize' => "Personalize"
	];

	$footer = [
		'check' => "You came into this page from an invalid link",//alert

		'alt1' => "Language",

		'bug' => "Report a bug",

		'advice' => "Give us some advice",

		'license1' => "This work is licensed under a ",

		'license2' => "Creative Commons Attribution-NoDerivatives 4.0 International License",

		'alt2' => "Creative Commons License",

		'privacy' => "Privacy Policy",

		'terms' => "Terms of Service"
	];

	$typed = [
		'title' => "Welcome to Typed",

		'results' => [
			'signup' => "You successfully signed up",
			'login' => "You successfully logged in",
			'logout' => "You successfully logged out",
			'email' => "Click the link on your email to set a password",
			'instagram' => "Error connecting to Instagram. Try again",
			'taken' => "This Instagram profile is associated with another account"
		],

		'errors' => [
			'400' => "Bad Request",
			'401' => "Unauthorized",
			'403' => "Forbidden",
			'404' => "Not Found",
			'409' => "Conflict",
			'500' => "Internal Server Error",
			'501' => "Not Implemented",
			'502' => "Bad Gateway",
			'503' => "Service Unavailable",
			'504' => "Gateway Timeout",
			'505' => "HTTP Version Not Supported"
		],

		'congratulations' => "Congratulations",//alert

		'match' => "has added you to his Crushbox too",//alert

		'logged' => "Logged in as",

		'not-logged' => "Not logged in",

		'logout' => "Log out",

		'signup' => "Sign up",

		'login' => "Log in"
	];

	$instagram = [
		'title' => "Connect to Instagram",

		'description' => "Link your Typed account to Instagram to keep your favorite Social Networks always connected",

		'new' => "Create a new account",

		'existing' => "Link to an existing account",

		'posts' => "Posts",

		'followers' => "Followers",

		'following' => "Following"
	];

	$deletions = [
		'title' => "Instagram unlink requests",

		'user' => "User name",

		'email' => "User email",

		'link' => "Link to Instagram date",

		'deletion' => "Data deletion date",

		'source' => "Unlinked through"
	];

	$signup = [
		'title' => "Sign up",

		'description' => "Create a new Typed account to start answering your friends' questions",

		'errors' => [
			'spam' => "Too many emails sent",
			'invaliduser' => "Invalid username",
			'invalidemail' => "Invalid email",
			'user' => "This username already exists",
			'email' => "This email is associated with another account",
			'send' => "The email could not be sent. Try again later"
		],

		'confirm' => "You will receive a confirmation email with the instructions to set a password",

		'point' => "will get 400 points after your registration",

		'link' => "Link your profile to",

		'user' => "Username",

		'password' => "Password",

		'repeat' => "Repeat your password",

		'signup' => "Sign up",

		'register' => "Already registered?",

		'login' => "Log in"
	];

	$login = [
		'title' => "Log in",

		'description' => "Log into Typed to always take your account with you",

		'errors' => [
			'invaliduser' => "Invalid username",
			'invalidemail' => "Invalid email",
			'user' => "Username not found",
			'email' => "This email is not associated with any account",
			'pwd' => "Wrong password",
			'google' => "Invalid Google authentication"
		],

		'forbidden' => "You need to log in to access this page",

		'recovery' => "Password successfully updated",//alert

		'link' => "Link your profile to",

		'user' => "Username or Email",

		'validity' => "Enter a valid email",

		'password' => "Password",

		'keep' => "Keep me logged in",

		'login' => "Log in",

		'or' => "Or",

		'google' => "Log in with Google",

		'forgot' => "Forgot password",

		'recover' => "Recover it now",

		'register' => "Not registered yet",

		'signup' => "Sign up"
	];

	$recovery = [
		'title' => "Password recovery",

		'description' => "Never lose your account: get your password back",

		'errors' => [
			'spam' => "Too many emails sent",
			'invalid' => "Invalid email",
			'email' => "This email is not associated with any account",
			'send' => "The email could not be sent. Try again later"
		],

		'insert' => "Insert your email into the form below",

		'send' => "We will send you an email containing the recovery link",

		'recover' => "Recover your password"
	];

	$verify = [
		'title' => "Set a Password",

		'description' => "Security comes first on Typed: keep your data safe",

		'errors' => [
			'check' => "You came into this page from an invalid link",
			'length' => "Invalid password length",
			'pwd' => "The passwords do not match",
			'invalid' => "Invalid password request",
			'expired' => "Password request expired"
		],

		'link' => "Link your profile to",

		'pwd' => "New password",

		'pwd2' => "Repeat new password",

		'update' => "Set your password"
	];

	$main = [
		'anonymous' => "Anonymous",

		'hidden' => "Hidden",

		'visible' => "Visible",

		'listed' => "Listed",

		'link' => "Link in bio",

		'click' => "Take a screenshot or click",

		'download' => " to download the image"
	];

	$user = [
		'title' => isset($name) ? ($name === true ? "Invalid username" : ($name ? $name : "Empty username")) : '',

		'description' => isset($name) && is_string($name) ? $name . "'s Typed account: look at " . $name . "'s Types and ask a new question" : "Ask your friends what you want about their life and stay always connection with them",

		'errors' => [
			'success' => "<i>Type</i> successfully sent",
			'anonymous' => "You cannot set your name if you are not logged in",
			'hidden' => "Your <i>Type</i> is already hidden if you are not logged in",
			'length' => "Invalid <i>Type</i> length"
		],

		'points' => [//alert
			'success' => "20 points given successfully",
			'self' => "You cannot give points to yourself",
			'invalid' => "Invalid username",
			'conn' => "Error connecting to the server. Try again",
			'unknown' => "Unknown error. Try again",
			'time' => "You can only donate to someone once a day",
			'login' => "You need to log in to give some points"
		],

		'info' => [
			'visible' => "Your name will be visible above the <i>Type</i>",
			'anonymous' => "No one will be able to know who sent the <i>Type</i>",
			'listed' => "You will be able to edit or delete your <i>Type</i> from ",
			'hidden' => "Your <i>Type</i> will not be shown in the list of your <i>Types</i>",
			'login' => "You need to be logged in to access this feature"
		],

		'share' => "Share",

		'gain' => "Gain some points",

		'send' => "Send me a new Type",

		'alt1' => "Profile picture",

		'type' => "Write your Type here",

		'forbidden' => "You will always be anonymous if you are not logged in",

		'submit' => "Submit",

		'break' => "Do you want to submit the Type",//alert

		'meaning' => "What does it mean",

		'types' => "Your Types",

		'reply' => "Reply to some Types",

		'you' => "Check sent Types",

		'logged' => "You are not logged in",

		'login' => "Login",

		'signup' => "Signup",

		'all' => isset($name) ? $name . "'s Types" : '',

		'overflow' => "Types",

		'empty' => "does not have any Types: write your own",

		'found' => "User not found",

		'label' => "Search for another user",

		'search' => "Search for a user",

		'alt4' => "Search"
	];

	$reply = [
		'title' => "Reply to some Types",

		'reply' => [
			'success' => "Answer successfully sent",
			'type' => "You cannot reply to this <i>Type</i>",
			'length' => "Invalid answer length"
		],

		'delete' => [
			'success' => "<i>Type</i> successfully deleted",
			'type' => "You cannot delete this <i>Type</i>"
		],

		'rules' => "Here you can reply to the <i>Types</i> that your friends have sent to you",

		'protection' => "You can also delete the <i>Types</i> that you consider offensive or inappropriate",

		'edit' => "Remember: once you have replied to a <i>Type</i>, you can edit your answer",

		'send' => "Reply",

		'break' => "Do you want to submit your answer",//alert

		'confirm' => "Do you really want to delete this Type? This action cannot be undone",//alert

		'del' => "Delete",

		'input' => "Reply to this Type",

		'types' => "You do not have any new Types",

		'back' => "See all your Types"
	];

	$types = [
		'title' => "Check all your Types",

		'edit' => [
			'success' => "<i>Type</i> successfully edited",
			'type' => "You cannot edit this <i>Type</i>",
			'length' => "Invalid <i>Type</i> length"
		],

		'delete' => [
			'success' => "<i>Type</i> successfully deleted",
			'type' => "You cannot delete this <i>Type</i>"
		],

		'visibility' => [
			'success' => "<i>Type</i> visibility successfully updated",
			'type' => "You cannot change the visibility of this <i>Type</i>"
		],

		'hide' => [
			'success' => "<i>Type</i> successfully hidden",
			'type' => "You cannot hide this <i>Type</i>"
		],

		'answer' => [
			'success' => "Answer successfully edited",
			'type' => "You cannot edit this answer",
			'length' => "Invalid answer length"
		],

		'rules' => "These are the <i>Types</i> and the answers that you have sent so far: you can edit or delete them up to 1 day after sending",

		'restrictions' => "You can only edit your <i>Type</i> if it has not already been answered",

		'show' => "The <i>Types</i> that you marked as <i>hidden</i> are not shown on this page",

		'types' => "Types",

		'answers' => "Answers",

		'send' => "Edit",

		'break' => "Do you want to submit your change",//alert

		'confirm1' => "Do you really want to delete this Type",//alert

		'undo' => "This action cannot be undone",//alert

		'del' => "Delete",

		'confirm2' => "Do you really want to hide the Type from this page",//alert

		'input1' => "Edit this Type",

		'notypes' => "You have not sent any Types yet",

		'back' => "See received Types",

		'input2' => "Edit this answer",

		'noanswers' => "You have not replied to any Types yet",

		'reply' => "Reply to some Types"
	];

	$points = [
		'title' => "Gain some points",

		'description' => "Gain more points to show your friends how much effort you take in things you do",

		'copy' => "Link copied to Clipboard",//alert

		'gain' => [
			'title' => "How to gain points",
			'gain' => "You gain",
			'1' => "point for each <i>Type</i> from a non-logged user",
			'10' => "points for each <i>Type</i> from a logged user",
			'20' => "points if someone donates to you",
			'30' => "points for each answer to a <i>Type</i> or Instagram share",
			'400' => "points if you share this app with someone",
			'1000' => "points if you add Typed to your Instagram biography"
		],

		'gifts' => [
			'title' => "Gifts",
			'give' => "You can give 20 points to someone once a day",
			'lose' => "You won't lose the points you donate, they will be simply added to whoever you want"
		],

		'you' => [
			'title' => "Your points",
			'points1' => "You currently have",
			'points2' => "points",
			'position1' => "You are in",
			'position2' => "position"
		],

		'share' => [
			'title' => "Share Typed with someone",
			'rules' => "If someone signs up to Typed by clicking on your link, you will automatically receive 400 points",
			'copy' => "click here to copy",
			'note' => "Remember: your friend has to click on the link before signing up"
		],

		'biography' => [
			'title' => "Add Typed to your biography",
			'link1' => "Write",
			'link2' => "inside your biography to gain 1000 points",
			'check' => "Check again",
			'see' => "See your bio",
			'hide' => "Hide your bio",
			'note' => "Note: if you remove Typed from your biography, we will remove your 1000 points too",
			'empty' => "Your biography is empty"
		],

		'instagram' => [
			'link1' => "Your profile is not linked to Instagram. Click",
			'link2' => "to connect your accounts",
			'conn' => "Sorry, we cannot check your biography at the moment because of an Instagram problem. Try again later",
			'none' => "You do not have Typed in your Instagram biography. Add it to gain 1000 points",
			'done' => "Good job! You already have Typed in your Instagram biography"
		]
	];

	$profile = [
		'title' => "Profile",

		'description' => "Access your Crushbox, donate some points or edit your profile preferences",

		'errors' => [//alert
			'success' => "20 points given successfully",
			'self' => "You cannot give points to yourself",
			'invalid' => "Invalid username",
			'conn' => "Error connecting to the server. Try again",
			'unknown' => "Unknown error. Try again",
			'time' => "You can only donate to someone once a day",
			'login' => "You need to log in to give some points",
			'crushbox' => "You cannot access someone else\\'s Crushbox"
		],

		'found' => "User not found",//alert

		'alt1' => "Settings",

		'alt2' => "Profile picture",

		'followers' => "Followers",

		'following' => "Following",

		'points' => "Points"
	];

	$crushbox = [
		'title' => "Crushbox",

		'description' => "Keep your secrets with you, and make your dream come true",

		/*start*/
		'start' => [
			'length' => "Invalid password length",
			'pwd' => "The passwords do not match"
		],

		'welcome' => [
			'title' => "Welcome to Crushbox",
			'first' => "You can choose up to three <i>Crushes</i>",
			'second' => "Your <i>Crushes</i> will not be notified if you choose them, unless they set you too as their <i>Crush</i>",
			'third' => "If your <i>Crush</i> chooses you into the <i>Crushbox</i>, you will be notified and",
			'fourth' => "Congratulations: you have found your partner"
		],

		'rules' => [
			'title' => "Rules",
			'first' => "You can choose up to three <i>Crushes</i> for your <i>Crushbox</i>",
			'second' => "To set a <i>Crush</i>, get into your <i>Crushbox</i> and enter the Typed username of your secret <i>Crush</i>",
			'third' => "Once you have set a <i>Crush</i>, you cannot unset it for 10 days",
			'fourth' => "If you want you can protect your <i>Crushbox</i> with a password: it will lock automatically after ",
			'fifth' => " minutes"
		],

		'pwd' => "Set a password",

		'not-pwd' => "Do not set a password",

		'set' => "Set password",

		'not-set' => "Get started",

		'password' => "Password",

		'repeat' => "Repeat your password",

		/*login*/
		'login' => [
			'pwd' => "Wrong password"
		],

		'expire1' => "Insert your password (it will expire after ",

		'expire2' => " minutes)",

		'join' => "Get into",

		/*crushbox*/
		'errors' => [
			'success' => "<i>Crushbox</i> successfully updated",
			'self' => "You cannot set yourself as your <i>Crush</i>",
			'twice' => "You cannot set the same <i>Crush</i> twice",
			'length' => "Invalid <i>Crush</i> length",
			'first' => "The first <i>Crush</i> does not exist",
			'second' => "The second <i>Crush</i> does not exist",
			'third' => "The third <i>Crush</i> does not exist",
			'start' => "<i>Crushbox</i> successfully set",
			'login' => "You successfully logged in"
		],

		'congratulations' => "Congratulations",

		'match' => "has added you to his <i>Crushbox</i> too",

		'added' => "You have been added to ",

		'person' => " person's <i>Crushbox</i>! Who could it be?",

		'people' => " people's <i>Crushbox</i>! Who could they be?",

		'first' => "First",

		'second' => "Second",

		'third' => "Third",

		'expire' => "Expire time",

		'logout' => "Log out",

		'add' => "Add",

		'reset' => "Reset",

		'update' => "Update",

		'tutorial' => "View rules or<br />Reset password"
	];

	$settings = [
		'title' => "Settings",

		'description' => "Edit your username, your email or update your profile picture",

		'file' => [
			'success' => "Avatar successfully updated",
			'error' => "Error uploading the file",
			'size' => "The image has to be bigger than 3KB and smaller than 2MB",
			'invalid' => "Invalid ",
			'image' => " file: upload an image"
		],

		'remove' => [
			'success' => "Avatar successfully removed",
			'empty' => "You had no profile picture",
			'error' => "Could not delete the file"
		],

		'user' => [
			'success' => "Username successfully updated",
			'invalid' => "Invalid username",
			'taken' => "This username already exists"
		],

		'email' => [
			'success' => "Email successfully updated",
			'pending' => "Check your email to confirm the update",
			'spam' => "Too many emails sent",
			'invalid' => "Invalid email",
			'taken' => "This email is associated to another account",
			'send' => "The email could not be sent. Try again later",
			'link' => "Invalid email changing link",
			'expired' => "Email changing link expired"
		],

		'privacy' => [
			'success' => "Privacy successfully updated"
		],

		'unlink' => [
			'success' => "Successfully unlinked from Instagram",
			'instagram' => "Instagram has already been unlinked through the application"
		],

		'old' => [
			'success' => "Password successfully updated",
			'wrong' => "Wrong password"
		],

		'pwd' => [
			'length' => "Invalid password length",
			'match' => "The passwords do not match"
		],

		'avatar' => [
			'title' => "Change your avatar",
			'remove' => "Remove your avatar"
		],

		'account' => [
			'title' => "Account Settings",
			'user' => "Change username",
			'email' => "Change email",
			'private' => "Private",
			'public' => "Public",
			'unlink' => "Unlink your profile from ",
			'link' => "Link your profile to Instagram"
		],

		'password' => [
			'title' => "Reset Password",
			'old' => "Old password",
			'pwd' => "New password",
			'pwd2' => "Repeat new password"
		],

		'reset' => "Reset",

		'save' => "Save Changes"
	];

	$style = [
		'title' => "Personalize",

		'description' => "Choose your style to get the best experience from Typed",

		'errors' => [
			'green' => "Invalid green color",
			'blue' => "Invalid blue color",
			'brown' => "Invalid brown color",
			'white' => "Invalid white color",
			'black' => "Invalid black color",
			'gray' => "Invalid gray color"
		],

		'green' => "Green",

		'blue' => "Blue",

		'brown' => "Brown",

		'white' => "White",

		'black' => "Black",

		'gray' => "Gray",

		'keep' => "Associate with your account",

		'forbidden' => "You need to log in to keep your style",

		'delete' => "Delete your current style",

		'set' => "Set your new colors"
	];

	$contact = [
		'language' => "Feel free to write us in any language",

		'optional' => "optional",

		'logged' => "You need to log in to access this page",

		'goto' => "Go to",

		'main' => "Main page",

		'login' => "Log in",

		'signup' => "Sign up",

		'user' => "User page",

		'reply' => "Reply to Types",

		'types' => "Edit Types",

		'points' => "Gain points",

		'search' => "Search page",

		'instagram' => "Instagram log in",

		'profile' => (isset($_SESSION['id']) ? $_user : "Profile") . " page",

		'settings' => "Settings",

		'style' => "Personalize style",

		'other' => "Other"
	];

	$bug = [
		'title' => "Report a Bug",

		'description' => "Help us improve ourselves and your experience",

		'errors' => [
			'success' => "Bug report sent successfully",
			'page' => "Invalid website page",
			'email' => "Invalid email",
			'content' => "Invalid length of your bug report"
		],

		'paragraph' => "Report here any bug you have found into this website to help us improve",

		'page' => "Which page have you found the bug in",

		'textarea' => "Insert here an explanation of the bug",

		'submit' => "Submit Report"
	];

	$advice = [
		'title' => "Give us some Advice",

		'description' => "Tell us what you think to turn your ideas into reality",

		'errors' => [
			'success' => "Piece of advice sent successfully",
			'page' => "Invalid website page",
			'email' => "Invalid email",
			'content' => "Invalid length of your piece of advice"
		],

		'paragraph' => "Give us some advice about the website to help us improve",

		'page' => "Which page is your advice for",

		'textarea' => "Insert here an explanation of your piece of advice",

		'submit' => "Submit Advice"
	];
