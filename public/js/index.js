const api_url = 
      "/productItem";

async function checkWatInWinkelWagenZit(url) {
      const response = await fetch(url);
      const eindTotaalArr = [];
      const plekVoorEindTotaal = document.querySelector('#plekVoorEindTotaal');
      var eindTotaalMetPunt = 0;
      

      var rawData = await response.json();
      var productList = rawData[0];
      
      // console.log(productList.length);

      //Voor elke product maaken we sws een hidden element aan en als deze al in de winkel wage zit dat laaten we deze gelijk zien
      productList.forEach(element => {
            // console.log(element['price']);

            //cookie naam aan maken in var
            var cookieName = 'product' + element['id'];

            //cookie data ophalen met var cookieName
            var opgeslagenProduct = getCookieByName(cookieName);

            //Html elementen ophalen waar data in moet komen te staan 
            const div = document.querySelector('#product' + element['id']);
            const productValueH1 = document.querySelector('#productAantal' + element['id']);
            const plekVoorbedrag = document.querySelector('#plekVoorbedrag' + element['id']);

            // console.log(cookieName);
            // console.log(opgeslagenProduct);

            //Als item niet in winkel wagen is / een cookie heeft niet laten zien anders als wel met x naam bestaat laten zien met de juiste data en berekening/ aantallen
            if (opgeslagenProduct[0] == 0) {
                  div.style.display = 'none';
            } else if (opgeslagenProduct[0] == cookieName) {
                  div.style.display = 'block';
                  productValueH1.innerHTML = opgeslagenProduct[1];

                  //, met . vervangen omdat pc ander moeilijk doet met het optellen
                  var priceMetPunt = element['price'].replace(/,/g, ".");

                  //de berekening voor een product
                  var opgeteldBedrag = opgeslagenProduct[1] * priceMetPunt;

                  // console.log(opgeteldBedrag);

                  //Totaal afronden op twee decimaal
                  var opgeteldBedragTweeDecimaal = opgeteldBedrag.toFixed(2);

                  //Terug veranderen naar string zodat we . weer kunnen veranderen naar , anders doet pc moeilijk
                  var opgeteldBedragString = opgeteldBedragTweeDecimaal.toString();

                  //Data displayen in HTML en . met , vervangen
                  plekVoorbedrag.innerHTML = opgeslagenProduct[1] + '  ' + 'X' + ' ' + element['price'] + ' = ' + opgeteldBedragString.replace(/\./g, ",");

                  //Alles in arr zetten voor totaal eind berekening
                  eindTotaalArr.push(opgeteldBedrag);  
            }

      });

      // console.log(eindTotaalArr);

      //Voor elke data in arr tel op aan eindTotaalMetPunt
      for (let i = 0; i < eindTotaalArr.length; i++) {
            // console.log(eindTotaalArr[i]);
            eindTotaalMetPunt += eindTotaalArr[i];
      }
      
      //Totaal afronden op twee decimaal
      var eindTotaalMetPuntAfgerond = eindTotaalMetPunt.toFixed(2);

      //Terug veranderen naar string zodat we . weer kunnen veranderen naar , anders doet pc moeilijk
      var eindTotaalMetPuntString = eindTotaalMetPuntAfgerond.toString();

      // console.log(eindTotaalMetPuntString.replace(/\./g, ","));

      // . met , vervangen
      var eindTotaalMetCommaString = eindTotaalMetPuntString.replace(/\./g, ",");

      //Data displayen in HTML
      plekVoorEindTotaal.innerHTML = 'Eindtotaal = ' + eindTotaalMetCommaString;

}

//functie aanroepen zodat alles getriggerd word op laden of wanneer een andere functie getriggerd word voor optimale visuals
checkWatInWinkelWagenZit(api_url);

//Functie om aantal toe te voegen in winkelmand
function productInWinkelWagenZetten(id) {
      //Html elementen ophalen waar data in moet komen te staan 
      const div = document.querySelector('#product' + id);
      const productValueH1 = document.querySelector('#productAantal' + id);

      //Naam voor cookie ophalen
      var nameGekozenProduct = 'product' + id;
      
      //Data uit cookie op halen
      var opgeslagenProduct = getCookieByName(nameGekozenProduct);

      //Als product nog niet is opgeslagen nu wel een opslaan anders een toevoegen aan bestaande en visual updaten
      if (opgeslagenProduct == 0) {
            div.style.display = 'block';
            document.cookie = nameGekozenProduct + "=" + 1;
      } else {
            div.style.display = 'block';
            document.cookie = nameGekozenProduct + "=" + ++opgeslagenProduct[1];
            productValueH1.innerHTML = opgeslagenProduct[1];
      }

      //async function aan roepen voor optimale visuals
      checkWatInWinkelWagenZit(api_url);
}

//Functie om aantal weg te halen uit winkelmand
function productInWinkelWagenVerweideren(id) {
      //Html elementen ophalen waar data in moet komen te staan 
      const div = document.querySelector('#product' + id);
      const productValueH1 = document.querySelector('#productAantal' + id);

      //Naam voor cookie ophalen
      var nameGekozenProduct = 'product' + id;    

      //Data uit cookie op halen
      var opgeslagenProduct = getCookieByName(nameGekozenProduct);

      //Zeker zijn dat element word laten zien
      div.style.display = 'block';

      //Aantal met een verminderen
      document.cookie = nameGekozenProduct + "=" + --opgeslagenProduct[1];

      //Als lager of gelijk aan 0 hide element en verweider cookie ander gewoon laten zien
      if (opgeslagenProduct[1] <= 0) {
            div.style.display = 'none';
            document.cookie = nameGekozenProduct + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;"
      } else {
            productValueH1.innerHTML = opgeslagenProduct[1];
      }

      //async function aan roepen voor optimale visuals
      checkWatInWinkelWagenZit(api_url);
}

//Functie om cookie mooi op te halen omdat een cookie eigenlijk als een blob word mee gegeven moet ik het omzetten naar objecten om er gebruik van te kunnen maken
function getCookieByName(name) {
      //split data op ; kijk wat de lengte is en split het daarna op = in een for om de data mooi weer te kunnen geven
      var parts = document.cookie.split('; '),
            len = parts.length,
            item, i, ret;
      for (i = 0; i < len; ++i) {
            item = parts[i].split('=');
            if (item[0] === name) {
                  ret = item;
                  // console.log(ret);
                  //Return uitkomst met data
                  return ret
            }
      } 
      //Return 0 als er niks in zit
      return 0;
}