// Tenmplat send Mail js

document.addEventListener('DOMContentLoaded', function () {
	var form = document.getElementById('formcontact');
	form.addEventListener('submit',function(e) {
		var formdata = new FormData(e.target);
		var email = formdata.get('formail');

		mail_subject = `Contact Play-Study`,
		mail_content = `Un nouveau contact sur le site internet : <b> ${email} </b>`;

		const xhr = new XMLHttpRequest();
		xhr.open("POST", './send.php', true);

		//Send the proper header information along with the request
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");

		xhr.onreadystatechange = () => { // Call a function when the state changes.
		if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			console.log(xhr.response);
		}
		}
		xhr.send(`mail_subject=${mail_subject}&mail_content=${mail_content}`);
	});
}, false);