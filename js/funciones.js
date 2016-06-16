function Habilitar(opc){
    
       document.getElementById(opc).style.backgroundColor = '#0B610B';
       switch (opc) {
        case "primera" :
            
                document.getElementById("cuartos").style.backgroundColor = '#4CAF50';
                document.getElementById("semis").style.backgroundColor = '#4CAF50';
                document.getElementById("final").style.backgroundColor = '#4CAF50';
                document.getElementById("primeraFase").style.display="block";
                document.getElementById("cuartosFinal").style.display="none";
                document.getElementById("semiFinales").style.display="none"
                document.getElementById("faseFinal").style.display="none"
            break;
        
        case "cuartos" : 
                document.getElementById("primera").style.backgroundColor = '#4CAF50';
                document.getElementById("semis").style.backgroundColor = '#4CAF50';
                document.getElementById("final").style.backgroundColor = '#4CAF50';
                document.getElementById("primeraFase").style.display="none";
                document.getElementById("cuartosFinal").style.display="block";
                document.getElementById("semiFinales").style.display="none"
                document.getElementById("faseFinal").style.display="none"
            break;
        
        case "semis" : 
                document.getElementById("cuartos").style.backgroundColor = '#4CAF50';
                document.getElementById("primera").style.backgroundColor = '#4CAF50';
                document.getElementById("final").style.backgroundColor = '#4CAF50';
                document.getElementById("primeraFase").style.display="none";
                document.getElementById("cuartosFinal").style.display="none";
                document.getElementById("semiFinales").style.display="block"
                document.getElementById("faseFinal").style.display="none"
            break;
        
        case "final" : 
                document.getElementById("cuartos").style.backgroundColor = '#4CAF50';
                document.getElementById("semis").style.backgroundColor = '#4CAF50';
                document.getElementById("primera").style.backgroundColor = '#4CAF50';
                document.getElementById("primeraFase").style.display="none";
                document.getElementById("semiFinales").style.display="none"
                document.getElementById("cuartosFinal").style.display="none";
                document.getElementById("faseFinal").style.display="block"
            break;
        

    }
    return false;
}

