/**
 * Created by stijn on 23/10/2017.
 */
function confirmation(e) {
    console.log("echo");
    var target = e.currentTarget;
    var targetid = target.getAttribute('id');

    var conf = document.getElementsByClassName(targetid);

    for (var i = 0; i < conf.length; i++) {
        conf[i].style.display = 'inline';
    }

}
function cancel(e) {
    var target = e.currentTarget;
    var targetid = target.getAttribute('id');

    var conf = document.getElementsByClassName(targetid);
    for (var i = 0; i < conf.length; i++) {
        conf[i].style.visibility = 'none';
    }


}
function EventBinder() {
    console.log("echo");
    let submit = document.getElementById('btnSubmit');
    submit.addEventListener('submit', 'confirmation');
}
EventBinder();