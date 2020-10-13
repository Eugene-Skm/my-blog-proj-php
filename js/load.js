function sideadjuster() {
  const sub = document.getElementById("sbar");
sub.style.width = sub.contentWindow.document.body.scrollWidth + "px";
sub.style.height = sub.contentWindow.document.body.scrollHeight + "px";
}