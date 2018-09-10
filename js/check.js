var Check = {
  checkURL : function (value){
    part1="^(?:(?:https?):\\/\\/(?:[a-z0-9_-]{1,32}";
    part2="(?::[a-z0-9_-]{1,32})?@)?)?(?:(?:[a-z0-9-]{1,128}\\.)+(?:";
    part3="[a-z]{2,})|(?!0)(?:(?";
    part4="!0[^";
    part5=".]|255)[0-9]{1,3}\\.){3}(?!0|255)[0-9]{1,3})(?:\\/[a-z0-9.,_@%&";
    part6="?+=\\~\\/-]*)?(?:#[^ '"+'"'+"&<>]*)?$";
    part=part1+part2+part3+part4+part5+part6;
    reg=new RegExp(part);
    return reg.test(value.toLowerCase());
  },
  
  checkEmail : function (value){
    reg=/^[\d\w-_\.]+@[\d\w-_\.]+$/;
    return reg.test(value.toLowerCase());
  },
  
  checkPass : function (value){
    reg=/^[a-zA-z0-9]{6,32}$/;
    return reg.test(value);
  },

  checkCPass : function (value1, value2){
    return value1==value2;
  },

  checkText : function (value){
    reg=/[^\s]/;
    return reg.test(value);
  },
  
  checkInt : function (value){
    reg=/^[0-9]{1,}$/;
    return reg.test(value);
  },
  
  checkFloat : function (value){
    reg=/^[0-9]{1,}(\.[0-9]{1,})*$/;
    return reg.test(value);
  },

  checkForm : function (formid){
    
    var frm=$(formid).get(0);
    if(!frm) return false;

    var assign={'ctext':this.checkText,'curl':this.checkURL,'cemail':this.checkEmail,'cpass':this.checkPass,'cint':this.checkInt,'cfloat':this.checkFloat};
    var assign2={'ccpass':this.checkCPass};
    var cassign2={'ccpass':false};
    var error=false;
    var focus=false;
    var cpass=false;
    for (i=0; i<frm.elements.length; i++)
    {
      var curerr=false;
      var elem=frm.elements[i];
      var anames=elem.className.split(' ');
      for(j=0; j<anames.length; j++)
      {
        flag=anames[j].substring(0,1);
        name=anames[j].substring(1);
        if(assign[name])
        {
          check=false;

          if(flag=='r') check=true;
          else if(flag=='u' && elem.value!='') check=true;
          
          if(check && !assign[name](elem.value)) curerr=true;
        }
        else if(assign2[name])
        {
          if(cassign2[name])
          {
            if(!assign2[name](cassign2[name].value, elem.value)) curerr=true;
            cassign2[name]=false;
          }
          else cassign2[name]=elem;
        }
        if(curerr)
        {
          $(elem).addClass('errbg');
          error=true;
          $('#er'+elem.name).css({display:''});
          if(!focus)
          {
            elem.focus();
            focus=true;
          }        
        }
        else
        {
          $('#er'+elem.name).css({display:'none'});
          $(elem).removeClass('errbg');
        }        
      }
    }
    
    return !error;
  }
};

