
$(document).ready(function(){
    let c = 0;
    let Te = 0;
    var Tests = document.querySelectorAll('.test');
    var Reserver = document.querySelectorAll('.reserver');
    var Reserver2= document.querySelectorAll('.reserver2');
    console.log(Tests[1])
    for(i = 0 ; i<Tests.length ;i++){
        Te = 'Te'+i
        console.log('et')
        Tests[i].classList.add(Te)
        Reserver[i].classList.add(Te)
        Reserver2[i].classList.add(Te)
    }
    var Reserver = $(".reserver")
    var Reserver2 = $(".reserver2")
    var ttests = $(".test")
    Reserver.click((e)=>{
        let cl = e.currentTarget.classList[e.currentTarget.classList.length - 1]
        console.log(cl)
        let Cl = document.getElementsByClassName(cl)[0];
        Cl.classList.toggle('bg-danger')
    }) 
    Reserver2.click((e)=>{
        let cl = e.currentTarget.classList[e.currentTarget.classList.length - 1]
        console.log(cl)
        let Cl = document.getElementsByClassName(cl)[0];
        Cl.classList.toggle('bg-primary')
    }) 



    
})