function pilihan()
  {
     // read the component from 'myform'
     var jumKomponen = document.myform.length;
     // no check all
     if (document.myform[0].checked == false)
        {
            for (i=1; i<=jumKomponen; i++)
            {
               if (document.myform[i].type == "checkbox") document.myform[i].checked = false;
            } 
        }
  }
