var restore_on = false;
var edit_on = false;
var edit_cur_val = '';
var edit_cur_name = '';

function start_edit(a,b) {}

function start_edit(val, newname) {
	if (edit_on == true) ret=nd();
	edit_on = true;
	restore_on = false;
	edit_cur_val = val;
	edit_cur_name = newname;
	return overlib('<img src="../templates/subSilver/images/auth_overall_forum/' + newname + '.gif">', FULLHTML);
}

function stop_edit() {
	edit_on = false;
	restore_on = false;
	edit_cur_val = '';
	edit_cur_name = '';
	return nd();
}

function change_auth(which, baseauth, forumid, type) {
	inputEl = document.getElementById('auth_' +forumid+ '_' +type);
	if (edit_on==true) {
		if (baseauth != edit_cur_name) {
			which.src = "../templates/subSilver/images/auth_overall_forum/" + baseauth + "_TO_" + edit_cur_name + ".gif";
			inputEl.value = edit_cur_name;
		} else {
			which.src = "../templates/subSilver/images/auth_overall_forum/" + baseauth + ".gif";
			inputEl.value = '';
		}
	} else if (restore_on==true) {
		which.src = "../templates/subSilver/images/auth_overall_forum/" + baseauth + ".gif";
		inputEl.value = '';
	}
}

function start_restore() {
	edit_on = false;
	restore_on = true;
	return overlib('<img src="../templates/subSilver/images/auth_overall_forum/_restore.gif">', FULLHTML);
}