document.addEventListener("DOMContentLoaded", () => {
  const complete = document.querySelector("#complete");
  complete.addEventListener("click", () => {
    if (!document.board_form.subject.value) {
      alert("제목을 입력하세요!");
      document.board_form.subject.focus();
      return;
    }
    if (!document.board_form.content.value) {
      alert("내용을 입력하세요!");
      document.board_form.content.focus();
      return;
    }
    document.board_form.submit();
  });

  // const re_bt = document.querySelector("#re_bt");
  // re_bt.addEventListener("click", () => {
  //   if (!document.ripple_form.content.value) {
  //     alert("내용을 입력하세요!");
  //     document.ripple_form.content.focus();
  //     return;
  //   }
  //   document.ripple_form.submit();
  // });

  const aa = document.querySelector("#aa");
  aa.addEventListener("click", () => {
    if (!document.board_form.id) {
      alert("내용을 입력하세요!");
      document.board_form.content.focus();
      return;
    }
    document.board_form.submit();
  });

});


