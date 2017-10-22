/**
 * Created by benhe on 23/10/2017.
 */
function confirmation(e) {
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
    btndel = document.getElementsByClassName('del');
    for (var i = 0; i < btndel.length; i++) {
        btndel[i].addEventListener('click', confirmation);

    }
    btncancel = document.getElementsByClassName('nee');
    for (var i = 0; i < btncancel.length; i++) {
        btncancel[i].addEventListener('click', cancel);
    }
}
EventBinder();