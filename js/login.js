document.addEventListener("DOMContentLoaded", () => {
    const login = document.querySelector(`#logins`)
    login.addEventListener("click", () => {
        if (!document.login_form.id.value) {
            alert("아이디를 입력하세요");
            document.login_form.id.focus();
            return;
        }
        if (!document.login_form.pass.value) {
            alert("비밀번호를 입력하세요");
            document.login_form.pass.focus();
            return;
        }
        document.login_form.submit();
    })

})