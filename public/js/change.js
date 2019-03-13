let submit=document.getElementById('submit');
submit.addEventListener('click',()=>{
	let q=document.getElementById('q').value;
	let title=document.getElementById('title').value;
	let question=document.getElementById('question').value;
	let a=document.getElementById('a').value;
	let b=document.getElementById('b').value;
	let c=document.getElementById('c').value;
	let d=document.getElementById('d').value;
	let correct=document.getElementById('correct').value;
	let points=document.getElementById('point').value;
	let request=new XMLHttpRequest();
	
	request.onreadystatechange=()=>{
		if (request.readyState===XMLHttpRequest.DONE) {
			if (request.status===200) {
				let response=request.responseText;
				console.log(response);
				let result=document.getElementById('result');
				result.innerHTML=response;
				result.style.color="green";
			}
		}
	};

	request.open('POST','/change');
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.send('q='+encodeURIComponent(q)+'&title='+encodeURIComponent(title)+'&question='+encodeURIComponent(question)+'&a='+encodeURIComponent(a)+'&b='+encodeURIComponent(b)+'&c='+encodeURIComponent(c)+'&d='+encodeURIComponent(d)+'&correct='+encodeURIComponent(correct)+'&points='+encodeURIComponent(points));
});