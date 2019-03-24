//form reference for sign up form
const agentsuSubmit = $('#agentsu-submit');

//form reference for sign in form
const agentsiSubmit = $('#agentsi-submit');

//agent signup validator function
let suValidator = (e) => {
    const asuName = $('#agentsu-name').val();
    const asuEmail = $('#agentsu-email').val();
    const asuPassword = $('#agentsu-password').val();
    e.preventDefault();
    if((asuEmail && asuPassword && asuName )===''){
        console.log('fill in empty parts');
    }else{
        const asudata = $('#agentsu-form').serialize();
        console.log('signing up.. sending to back end');
        $.ajax({
            url:'agent/RegisterAgent.php',
            method:'post',
            dataType:'json',
            data:asudata,
            success:(response)=>{
                console.log('signed up');
            }
        });
    }
}
//agent signin validator function
let siValidator = (e) =>{
    const asiEmail = $('#agentsi-email').val();
    const asiPassword = $('#agentsi-password').val();
    e.preventDefault();
    if((asiEmail && asiPassword )===''){
        console.log('fill in empty parts');
    }else{
        const asidata = $('#agentsi-form').serialize();
        console.log('logging in...');
        $.ajax({
            url:'agent/Login.php',
            method:'post',
            dataType:'json',
            data:asidata,
            success:(response)=>{
                if(response==0){
                    console.log('wrong details');
                }else{
                    window.location.href=response;
                }
                
            }
        });
    }
}

agentsuSubmit.on('click',suValidator);
agentsiSubmit.on('click',siValidator);