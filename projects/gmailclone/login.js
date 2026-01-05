
 
 document.getElementById('btn').onclick=function (){
   let user=document.getElementById('user').value ;
 let pass=document.getElementById('user2').value;
 console.log(user);
 console.log(pass);
   if(user=='ismail' && pass=='ismail@786'){
        console.log('login sucessfull');
        window.alert('login done');
    }else{
      window.alert('login failed');
    }


}