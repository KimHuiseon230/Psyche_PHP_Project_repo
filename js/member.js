document.addEventListener("DOMContentLoaded", () => {
  // 상수
  const cancel = document.querySelector("#cancel")
  const btn_zipcode = document.querySelector("#btn_zipcode")

  // 이벤트 처리 
  btn_zipcode.addEventListener("click", () => {
    const form = document.member_form

    new daum.Postcode({
      oncomplete: function (data) {

        let addr = ""
        let extra_addr = ""
        //지번, 도로명 선택
        if (data.userSelectedType == "J") {
          addr = data.jibunAddress
        } else if (data.userSelectedType == "R") {
          addr = data.roadAddress
        }
        //동이름 점검
        if (data.bname != '') {
          extra_addr = data.bname
        }
        //빌딩명 점검
        if (data.buildingName != '') {
          if (extra_addr != '') {
            extra_addr += "," + data.buildingName
          } else {
            extra_addr = data.buildingName
          }
        }
        if (extra_addr != '') {
          extra_addr = "(" + extra_addr + ")"
        }
        addr = addr + extra_addr

        form.zipcode.value = data.zonecode;
        form.addr1.value = addr;
      }
    }).open();
  });

  let email_regx = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])/;
  let id_regx = /^[A-Za-z0-9_]{3,}$/;
  let name_regx = /^[가-힣]{2,4}$|^[A-z]{4,10}$/;
  let addr1_regx = '/[\S]+(도|시)\s[\S]+(구|군)\s[\S]/';
  let addr2_regx = '/[\S](면|동).*/i/';
  const send = document.querySelector("#send")
  send.addEventListener("click", () => {
    const form = document.member_form
    if (form.id.value.match(id_regx) == null) {
      alert("영문자, 숫자,만 입력 가능. 최소 3자이상");
      form.id.value = ""
      form.id.focus();
      return false;
    }
    if (form.id_chk.value == '0') {
      alert("아이디를 입력하세요!");
      form.id.focus();
      return false;
    }
    if (form.pass.value == '') {
      alert("비밀번호를 입력하세요!");
      form.pass.focus();
      return false;
    }
    if (form.pass_confirm.value == '') {
      alert("비밀번호 확인을 입력하세요!");
      form.pass_confirm.focus();
      return false;
    }
    if (form.pass.value !=
      form.pass_confirm.value) {
      alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
      form.pass.focus();
      form.pass_confirm.value = '';
      form.pass.select();
      return false;
    }
    if (form.name.value.match(name_regx) == null) {
      alert("공백없이 한글,영문,숫자만 입력 가능(한글 2자, 영문4자 이상)");
      form.name.focus();
      return false;
    }
    if (form.email_chk.value == '0') {
      alert("이메일 주소를 입력하세요!");
      form.email1.focus();
      return false;
    }
    if (form.email1.value.match(email_regx) == null) {
      alert("이메일 주소(앞부분)을 제대로 입력하세요!");
      form.email1.focus();
      return false;
    }

    if (form.email2.value == '') {
      alert("이메일 주소(뒷부분을)제대로 선택하세요!");
      form.email2.focus();
      return false;
    }
    if (form.zipcode.value == '') {
      alert("도로명 주소를 검색해주세요!");
      form.zipcode.focus();
      return false;
    }
    if (form.addr1.value.match(addr1_regx)) {
      alert("도로명 주소가 손상되었습니다.");
      form.addr1.focus();
      return false;
    }
    if (form.addr2.value == '' || form.addr2.value.match(addr2_regx)) {
      alert("동/호수가 누락되었습니다.");
      form.addr2.focus();
      return false;
    }
    alert("모두 입력완료했습니다.")
    form.submit();
  });

  cancel.addEventListener("click", () => {
    alert('취소 버튼을 눌렀습니다.');
    form.id.value = "";
    form.pass.value = "";
    form.pass_confirm.value = "";
    form.name.value = "";
    form.email1.value = "";
    form.email2.value = "";
    return;
  });

})
function check_id() {
  const form = document.member_form
  //   // 아이디 점검
  if (form.id.value == '') {
    alert("아이디를 입력하세요!");
    form.id.focus();
    return false;
  }
  //AJAX
  const xhr = new XMLHttpRequest()
  xhr.open("POST", "./member_check.php", true)

  //전송할데이터 생성
  const formdata = new FormData()
  formdata.append('id', form.id.value)
  formdata.append('mode', "id_chk")
  xhr.send(formdata)

  //서버에서 member_check_id.php 요청을 하면 돌려줄 JSON 데이터 도착이 완료하면 발생
  xhr.onload = () => {
    if (xhr.status == 200) {
      //{'result': 'success'} => {'result': 'success'}
      //JSON.parse json 객체를 자바스트립트 객체로 바꿔줌
      const data = JSON.parse(xhr.responseText)
      switch (data.result) {
        case 'fail':
          alert('사용할 수 없는 아이디입니다.')
          form.id.value = "";
          form.id_chk.value = "0";
          form.id.focus()
          break;
        case 'success':
          alert('사용할 수 있는 아이디입니다.')
          form.id_chk.value = "1";
          form.pass.focus()
          break;
        case 'empty_id':
          alert('아이디를 입력해주세요')
          form.id_chk.value = "0";
          form.id.focus()
          break;
        default:
      }
    } else {
      alert("서버통신이 안됩니다.")
    }
  }
}

function check_email() {
  const form = document.member_form
  // 이메일 점검
  if (document.member_form.email1.value == '') {
    alert("이메일 입력하세요!");
    form.email1.focus();
    return false;
  }
  //AJAX
  const xhr = new XMLHttpRequest()
  xhr.open("POST", "./member_check.php", true)

  //전송할데이터 생성
  const formdata = new FormData()
  formdata.append('email1', form.email1.value)
  formdata.append('email2', form.email2.value)
  formdata.append('mode', "email_chk")
  xhr.send(formdata)

  //서버에서 member_check_id.php 요청을 하면 돌려줄 JSON 데이터 도착이 완료하면 발생
  xhr.onload = () => {
    if (xhr.status == 200) {
      //{'result': 'success'} => {'result': 'success'}
      //JSON.parse json 객체를 자바스트립트 객체로 바꿔줌
      const data = JSON.parse(xhr.responseText)
      switch (data.result) {
        case 'fail':
          alert('사용할 수 없는 이메일입니다.')
          form.email_chk.value = "0";
          form.email1.value = "";
          form.email2.value = "";
          form.email1.focus()
          break;
        case 'success':
          alert('사용할 수 있는 이메일입니다.')
          form.email_chk.value = "1";
          form.email2.focus()
          break;
        case 'empty_email':
          alert('이메일를 입력해주세요')
          form.email_chk.value = "0";
          form.email1.focus()
          break;
        default:
      }
    } else {
      alert("서버통신이 안됩니다.")
    }
  }
}