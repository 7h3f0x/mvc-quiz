let submit=document.getElementById('submit');
submit.addEventListener('click',()=>{
	let q=document.getElementById("q").value;
	let tags=document.getElementsByName('option');
	let answer;
	for(let i=0;i<tags.length;i++){
		if (tags[i].checked) {
			answer=tags[i].value;
		}
	}

	let request=new XMLHttpRequest();
	request.onreadystatechange=function(){
		if (request.readyState===XMLHttpRequest.DONE) {
			if (request.status===200) {
				let response=JSON.parse(this.responseText);
				console.log(response);
				document.getElementById('points').innerHTML=response.points;
				document.getElementById('result').innerHTML=response.result;
				if (response.result==='correct') {
					document.getElementById('result').style.color="green";
				}else{
					document.getElementById('result').style.color="red";
				}
			}
		}
	};
	request.open('POST','/problem');
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.send('q='+encodeURIComponent(q)+"&option="+encodeURIComponent(answer));
});