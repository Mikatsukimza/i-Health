var arrErrorInfos = ["用户名长度应为5~16个字符,并且以字母开头",
	"密码长度应为6~20个字符",
	"密码过于简单，请尝试字母+数字",
	"两次填写的密码不一致",
	"请填写正确的手机号",
	"用户名已注册",
	"用户名不存在"
];

var arrCorrectInfos = ["用户名可用",
	"密码可用",
	"密码一致",
	"手机号码可用"
];

var arrInfos = ["5~16个字符，可使用字母、数字、下划线，需以字母开头",
	"6~20个字符，区分大小写",
	"请再次填写密码",
	"忘记密码可用手机号快速登录",
	""
];

//登录界面 用户名检验
function checkUsername() {
	var nameValue = document.getElementById("userName").value;
	var nameMsgObj = document.getElementById("usernameMsg");
	if (/^\s*$/.test(nameValue)) {
		nameMsgObj.innerHTML = "<font color='red'>用户名不能为空</font>";
		return false;
	} else if (!/^[a-zA-Z]\w{5,15}$/.test(nameValue)) {
		nameMsgObj.innerHTML = "<font color='red'>用户名格式错误</font>";
		return false;
	} else {
		nameMsgObj.innerHTML = "";
	}
	return true;
}
//登录界面 密码检验
function checkPassword() {
	var pwdValue = document.getElementById("userPwd").value;
	var pwdMsgObj = document.getElementById("passwordMsg");
	if (/^\s*$/.test(pwdValue)) {
		pwdMsgObj.innerHTML = "<font color='red'>密码不能为空</font>";
		return false;
	} else if (!/^\w{6,20}$/.test(pwdValue)) {
		pwdMsgObj.innerHTML = "<font color='red'>密码格式错误</font>";
		return false;
	} else {
		pwdMsgObj.innerHTML = "";
	}
	return true;
}
//注册界面 用户名重复检测
function checkRegUsername() {
	var nameValue = document.getElementById("userName1").value;
	var nameMsgObj = document.getElementById("usernameMsg1");
	$(document).ready(function () {
		$("#userName1").blur(function () {
			var a = $(this).val();
			$.post("../php/checkUser.php", {
				userName1: a
			}, function (text, status) {
				nameMsgObj.innerHTML = "<font color='red'>" + text + "</font>";
			}, "text");
		})
	})
	if (/^\s*$/.test(nameValue)) {
		nameMsgObj.innerHTML = "<font color='red'>用户名不能为空</font>";
		return false;
	} else if (!/^[a-zA-Z]\w{5,15}$/.test(nameValue)) {
		nameMsgObj.innerHTML = "<font color='red'>用户名格式错误</font>";
		return false;
	} else {
		nameMsgObj.innerHTML = "";
	}
	return true;
}
//注册界面 密码检验
function checkRegPwd() {
	var pwdValue = document.getElementById("userPwd1").value;
	var pwdMsgObj = document.getElementById("passwordMsg1");
	if (/^\s*$/.test(pwdValue)) {
		pwdMsgObj.innerHTML = "<font color='red'>密码不能为空</font>";
		return false;
	} else if (!/^\w{6,20}$/.test(pwdValue)) {
		pwdMsgObj.innerHTML = "<font color='red'>密码格式错误</font>";
		return false;
	} else {
		pwdMsgObj.innerHTML = "";
	}
	return true;
}
//注册界面 确认密码检测
function checkRegCfmPwd() {
	var pwdValue = document.getElementById("userPwd1").value;
	var cfmpwdvalue = document.getElementById("repeateuserPwd").value;
	var cfmpwdObj = document.getElementById("pwdCfmMsg");
	if (/^\s*$/.test(cfmpwdvalue)) {
		cfmpwdObj.innerHTML = "<font color='red'>确认密码不能为空</font>";
		return false;
	} else if (pwdValue !== cfmpwdvalue) {
		cfmpwdObj.innerHTML = "<font color='red'>两次输入密码不一致</font>";
	} else {
		cfmpwdObj.innerHTML = "";
	}
}
//注册页面 手机号检测
function checkRegTel() {
	var telValue = document.getElementById("telephone1").value;
	var telMsgObj = document.getElementById("telMsg");
	$(document).ready(function () {
		$("#telephone1").blur(function () {
			var a = $(this).val();
			$.post("../php/checkTel.php", {
				telephone1: a
			}, function (text, status) {
				telMsgObj.innerHTML = "<font color='red'>" + text + "</font>";
			}, "text");
		})
	})
	if (/^\s*$/.test(telValue)) {
		telMsgObj.innerHTML = "<font color='red'>手机号不能为空</font>";
		return false;
	} else if (!/\d{11}/.test(telValue)) {
		telMsgObj.innerHTML = "<font color='red'>请填入11位手机号</font>";
		return false;
	} else {
		telMsgObj.innerHTML = "";
	}
}
//注册界面 邮箱检验
function checkRegEmail() {
	var emailValue = document.getElementById("email1").value;
	var emailMsgObj = document.getElementById("emailMsg");
	$(document).ready(function () {
		$("#email1").blur(function () {
			var a = $(this).val();
			$.post("../php/checkEmail.php", {
				email1: a
			}, function (text, status) {
				emailMsgObj.innerHTML = "<font color='red'>" + text + "</font>";
			}, "text");
		})
	})
	if (/^\s*$/.test(emailValue)) {
		emailMsgObj.innerHTML = "<font color='red'>邮箱不能为空</font>";
		return false;
	} else if (!/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/.test(emailValue)) {
		emailMsgObj.innerHTML = "<font color='red'>邮箱格式不正确</font>";
		return false;
	} else {
		emailMsgObj.innerHTML = "";
	}
}
//个人信息修改页面 用户名检测
function checkexampleInputName() {
	var nameValue = document.getElementById("exampleInputName").value;
	var nameMsgObj = document.getElementById("exampleInputNameMsg");
	$(document).ready(function () {
		$("#exampleInputName").blur(function () {
			var a = $(this).val();
			$.post("../php/checkUser.php", {
				userName1: a
			}, function (text, status) {
				nameMsgObj.innerHTML = "<font color='red'>" + text + "</font>";
			}, "text");
		})
	})
	if (/^\s*$/.test(nameValue)) {
		nameMsgObj.innerHTML = "<font color='red'>用户名不能为空</font>";
		return false;
	} else if (!/^[a-zA-Z]\w{5,15}$/.test(nameValue)) {
		nameMsgObj.innerHTML = "<font color='red'>用户名格式错误</font>";
		return false;
	} else {
		nameMsgObj.innerHTML = "";
	}
	return true;
}
//个人信息修改页面 密码检测
function checkexampleInputPassword1() {
	var pwdValue = document.getElementById("exampleInputPassword1").value;
	var pwdMsgObj = document.getElementById("exampleInputPassword1Msg");
	if (/^\s*$/.test(pwdValue)) {
		pwdMsgObj.innerHTML = "<font color='red'>密码不能为空</font>";
	} else if (!/^\w{6,20}$/.test(pwdValue)) {
		pwdMsgObj.innerHTML = "<font color='red'>密码格式错误</font>";
		return false;
	} else {
		pwdMsgObj.innerHTML = "";
	}
	return true;
}
//个人信息修改页面 手机号检测
function checkexampleInputPhone() {
	var telValue = document.getElementById("exampleInputPhone").value;
	var telMsgObj = document.getElementById("exampleInputPhoneMsg");
	$(document).ready(function () {
		$("#exampleInputPhone").blur(function () {
			var a = $(this).val();
			$.post("../php/checkTel.php", {
				telephone1: a
			}, function (text, status) {
				telMsgObj.innerHTML = "<font color='red'>" + text + "</font>";
			}, "text");
		})
	})
	if (/^\s*$/.test(telValue)) {
		telMsgObj.innerHTML = "<font color='red'>手机号不能为空</font>";
	} else if (!/\d{11}/.test(telValue)) {
		telMsgObj.innerHTML = "<font color='red'>请填入11位手机号</font>";
	} else {
		telMsgObj.innerHTML = "";
	}
}
//个人信息修改页面 邮箱检测
function checkexampleInputEmail() {
	var emailValue = document.getElementById("exampleInputEmail").value;
	var emailMsgObj = document.getElementById("exampleInputEmailMsg");
	$(document).ready(function () {
		$("#exampleInputEmail").blur(function () {
			var a = $(this).val();
			$.post("../php/checkEmail.php", {
				email1: a
			}, function (text, status) {
				emailMsgObj.innerHTML = "<font color='red'>" + text + "</font>";
			}, "text");
		})
	})
	if (/^\s*$/.test(emailValue)) {
		emailMsgObj.innerHTML = "<font color='red'>邮箱不能为空</font>";
		return false;
	} else if (!/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/.test(emailValue)) {
		emailMsgObj.innerHTML = "<font color='red'>邮箱格式不正确</font>";
		return false;
	} else {
		emailMsgObj.innerHTML = "";
	}
}