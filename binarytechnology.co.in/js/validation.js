// JavaScript Document

function Global_validate(obj)  {
    var len=obj.length;
	for(i=0;i<len;i++)
	  {
	    if(obj.elements[i].title!='' && obj.elements[i].value=='' && obj.elements[i].disabled==false)
		  {
		    alert(obj.elements[i].title);
			obj.elements[i].focus();
			return false;
		  }
	  }
	return true;
 }
function trimspaces(str){
	while((str.indexOf(' ',0) == 0) && (str.length > 1))
	{
		str = str.substring(1, str.length);
	}
	while((str.lastIndexOf(' ') == (str.length - 1) && (str.length > 1)))
	{
		str = str.substring(0,(str.length - 1));
	}
	if((str.indexOf(' ',0) == 0) && (str.length == 1)) str = '';
	return str;
}
		  
function validate_form(Obj)	{	
	for ( i = 0; i < Obj.elements.length; i++) {
		formElem = Obj.elements[i];
		
		switch (formElem.type) {
			case 'text':
			case 'password':
			case 'select-one':
			case 'textarea':
			case 'file':
			case 'checkbox':
			case 'select-multiple':
					split_title=formElem.title.split("::");
					if(split_title[0]!='' && trimspaces(formElem.value)==''){
						alert(split_title[1]);
						formElem.focus();
						return false;
					}
					if((split_title[0]=='First Name' || split_title[0]=='Last Name' || split_title[0]=='Your Name') && trimspaces(formElem.value)!=''){
						//return false;
						
						if (/[^A-Za-z \d]/.test(formElem.value)){
							alert('Please enter valid '+ split_title[0] +'.');
							formElem.focus();
							return false;
						}
					}
															
					if(split_title[0]=='Image' && trimspaces(formElem.value)!='')
					{
						var jpeg_file=formElem.value;
						
						if((jpeg_file.lastIndexOf(".jpg")==-1) && (jpeg_file.lastIndexOf(".jpeg")==-1) && (jpeg_file.lastIndexOf(".JPG")==-1) && (jpeg_file.lastIndexOf(".JPEG")==-1) && (jpeg_file.lastIndexOf(".gif")==-1) && (jpeg_file.lastIndexOf(".GIF")==-1) && (jpeg_file.lastIndexOf(".png")==-1) && (jpeg_file.lastIndexOf(".PNG")==-1)) {
							//alert(jpeg_file.lastIndexOf(".jpg"));
							alert("Please upload only .jpg,.jpeg,.gif,.png extention file");
							return false;
						}
						
					}
					
					if(split_title[0]=='Email' ){
						//alert(document.getElementById("txtYourEmail").value);
						if(trimspaces(formElem.value)=='')
						{
							alert(split_title[1]);
							formElem.focus();
							return false;
						}
						if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(formElem.value)){
							}else{
								alert('Invalid E-mail Address, Please re-enter.');
								formElem.focus();
								return false;
						}
						var fEmail=trimspaces(formElem.value);
					}
					
					
					if(split_title[0]=='Password' ){
						if(formElem.value !='')
							{
								var strLength = formElem.value.length;
								var spaceindex = formElem.value.lastIndexOf(' ');
								if(strLength < 6)
								{
									alert("Please enter password of at least 6 characters.");
									formElem.focus();
									return false;
								}
								if(spaceindex!='-1')
								{
									alert("Please remove space from password.");
									formElem.focus();
									return false;
								}
							}
					}
					if(split_title[0]=='Confirm Password' ){
						if(formElem.value !='')
							{
								var strLength = formElem.value.length;
								var spaceindex = formElem.value.lastIndexOf(' ');
								if(strLength < 6)
								{
									alert("Please enter password of at least 6 characters.");
									formElem.focus();
									return false;
								}
								if(spaceindex!='-1')
								{
									alert("Please remove space from password.");
									formElem.focus();
									return false;
								}
								//alert(formElem.value);
								//alert(Obj.elements['txtPassword'].value);
								if(formElem.value != Obj.elements['txtPassword'].value){
									alert("Password and Confirm Password does not match.");
									formElem.focus();
									return false;
								}
							}
					}
					if(split_title[0]=='Confirm New Password' ){
						if(formElem.value !='')
							{
								var strLength = formElem.value.length;
								var spaceindex = formElem.value.lastIndexOf(' ');
								if(strLength < 6)
								{
									alert("Please enter password of at least 6 characters.");
									formElem.focus();
									return false;
								}
								if(spaceindex!='-1')
								{
									alert("Please remove space from password.");
									formElem.focus();
									return false;
								}
								//alert(formElem.value);
								//alert(Obj.elements['txtPassword'].value);
								if(formElem.value != Obj.elements['txtNewPassword'].value){
									alert("New Password and Confirm New Password does not match.");
									formElem.focus();
									return false;
								}
							}
					}
						
			break;
		}
	}//end of for loop
	return true;
}  

function CheckAll1(obj,name)
{
//	alert(obj);
	var flag=0;
	var count = obj.elements.length;
	for (i=0; i < count; i++) 
	{
		if(obj.elements[i].type == 'checkbox')
			if(obj.elements[i].checked == true)
			flag=flag+1;
	}
	if(flag>0){
		if(confirm("Are you sure to delete selected "+name+"(s)?"))
		{
			document.getElementById('token').value = "deleteall";
			obj.submit();   
		} else {
			var count = obj.elements.length;
			for (i=0; i < count; i++) 
			{
				obj.elements[i].checked =0;
				flag=false;
			}return false;	
		}
	}else {
		alert("Please select at least one "+name+".");
		return false;
	}
}
function CheckAll2(obj,name)
{
//	alert(obj);
	var flag=0;
	var count = obj.elements.length;
	for (i=0; i < count; i++) 
	{
		if(obj.elements[i].type=='textarea'){
			if(obj.elements[i].value==''){
				alert('Please enter message.');
				obj.elements[i].focus();
				return false;
			}
		}
		if(obj.elements[i].type == 'checkbox')
			if(obj.elements[i].checked == true)
			flag=flag+1;
			
	}
	if(flag>0){
		return true;
	}else {
		alert("Please select at least one "+name+".");
		return false;
	}
}

function CheckAll(obj)
{
	var count = obj.elements.length;

	for (i=0; i < count; i++) 
	{
		//if(obj.elements[i].type == 'checkbox' && obj.elements[i].id == 'chk')
		if(obj.elements[i].type == 'checkbox')
			obj.elements[i].checked = obj.chkall.checked;
	}
}