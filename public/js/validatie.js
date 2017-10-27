/**
 * Created by stijn on 23/10/2017.
 */

// in deze functie worden de inputs voornaam en achternaam gecontrolleerd op alleen letters en minstens 2 l"etters
function validatieInput() {
    console.log("echo");

    let isValid = true;

    let first = document.getElementById('firstname');
    let last = document.getElementById('lastname');
    let nameInputs = document.querySelectorAll(".controle");
    //  let email = document.getElementById('email');
    let regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    let re = /^[a-zA-Z ]{2,30}$/;
    let foutFirstname = document.getElementById('errorFirst');
    let nameInputslen = nameInputs.length;

    for (let i = 0; i < nameInputslen; i++) {
        if (nameInputs[i].value) {

            if (re.test(nameInputs[i].value)) {
                console.log("correct");
                nameInputs[i].style.borderColor = "initial";
                foutFirstname.innerHTML = "";

            } else {
                foutFirstname.innerHTML = "Een naam dat u hebt ingegeven is niet juist geschreven";
                first.classList.add('input-error');

                isOk = false;


            }


        } else {
            console.log("fout1");
            foutFirstname.innerHTML = "Dit veld mag niet leeg zijn";
            first.classList.add('input-error');
            isValid = false;
        }
    }

    // if(!re.test(first.value)){
    //
    //     first.classList.add('input-error');
    // }else{
    //     console.log("correct");
    //     isValid= true;
    // }



}

function EventBinder() {

    let controleInput = document.getElementsByClassName('controle');
    for (let i = 0; i < controleInput.length; i++) {
        controleInput[i].addEventListener('keyup', validatieInput);
    }

    //let controleEmail =  document.getElementById()
}
EventBinder();
