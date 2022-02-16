document.querySelector('.img-btn').addEventListener('click', function()
	{
		document.querySelector('.cont').classList.toggle('s-signup')
	}
);

  const form=document.getElementsByClassName("formulaire");
  const mdp=document.getElementById("mdp");
  const nom=document.getElementById("fullnom");
  const mdp1=document.getElementById("mdp1");
  form.addEventListener('submit', e => {
    e.preventDefault();
    
    checkinputs();
  });
  

  function checkinputs(){
    const nomvalue=nom.value.trim()
    const mdpvalue=mdp.value()
    const mdp1value=mdp1.value()
    if(nomvalue === '') {
      document.getElementById("demo").innerHTML='Username cannot be blank';
      document.getElementById("demo").style.color="red";
    } else {
      setSuccessFor(nom);
    }


  }
