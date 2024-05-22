
      // Replace VIRTUAL_PIN with the virtual pin number you want to read from
      const virtualPin2 = "v2";
      const virtualPin3 = "v3";

      // Set up the Blynk API URL
      const apiUrl2 = `https://blr1.blynk.cloud/external/api/get?token=${authToken}&${virtualPin2}`;
      const apiUrl3 = `https://blr1.blynk.cloud/external/api/get?token=${authToken}&${virtualPin3}`;
      const apiUrl4 = `https://blr1.blynk.cloud/external/api/isHardwareConnected?token=${authToken}`;


      // Set up the fetch options
      const fetchOptions1 = {
        method: "GET",
        mode: "cors",
        cache: "no-cache"
      };

      // Fetch the data from the Blynk API
      async function fetchData() {
        try {
          const response2 = await fetch(apiUrl2, fetchOptions1);
          const response3 = await fetch(apiUrl3, fetchOptions1);
          const response4 = await fetch(apiUrl4, fetchOptions1);

          const voltage = await response2.json();
          const ampere = await response3.json();
          const isHardwareConnected = await response4.json();


          // Extract the value from the response data
          const value2 = parseFloat(voltage).toFixed(2);
          const value3 = parseFloat(ampere).toFixed(2);
          var value4 = parseFloat(value2*value3).toFixed(2);
          const value5 = isHardwareConnected;
          

          if(value5 === true)
           {

            if (value2 >= 2.7 && value3 >= 1) {
                category = "Your Solar System is Working!";
                document.getElementById("device").style = "background: #fff; padding: 20px 15px 20px 20px; border-radius: 10px; border-left: 5px solid #2ecc71; box-shadow: 20px 15px 14px -5px rgba(0,0,0,0.15); width: 300px; display: flex; align-items: center; justify-content: space-between;";
                document.getElementById("voltage").innerHTML = "Voltage: " + value2 + "V";
                document.getElementById("ampere").innerHTML = "Ampere: " +  value3 + "mA";
                document.getElementById("watt").innerHTML = "Watt: " +  value4 + " mW";
                document.getElementById("vol").style = "--progress:" + value2;
                document.getElementById("amp").style = "--progress:" + value3;
                document.getElementById("wa").style = "--progress:" + value4;
                document.getElementById("vol").value = value2;
                document.getElementById("amp").value = value3;
                document.getElementById("wa").value = value4;
                document.getElementById("device").innerHTML = category;
                document.getElementById("display").style = "display: none;";
              }
              else{
                category = "Your solar system is malfunctioning.";
                document.getElementById("device").style = "background: #fff; padding: 20px 15px 20px 20px; border-radius: 10px; border-left: 5px solid #ff7f00; box-shadow: 20px 15px 14px -5px rgba(0,0,0,0.15); width: 300px; display: flex; align-items: center; justify-content: space-between;";
                document.getElementById("voltage").innerHTML = "Voltage: " + value2 + "V";
                document.getElementById("ampere").innerHTML = "Ampere: " +  value3 + "mA";
                document.getElementById("watt").innerHTML = "Watt: " +  value4 + " mW";
                document.getElementById("vol").style = "--progress:" + value2;
                document.getElementById("amp").style = "--progress:" + value3;
                document.getElementById("wa").style = "--progress:" + value4;
                document.getElementById("vol").value = value2;
                document.getElementById("amp").value = value3;
                document.getElementById("wa").value = value4;
                document.getElementById("device").innerHTML = category;
                document.getElementById("notice").innerHTML = "You could need to get in touch with customer service, or the night might be there where you left.";
                document.getElementById("display").style = "";
              }
           }
          else{
            category = "Your System Isn't Working!";
            document.getElementById("device").style = "background: #fff; padding: 20px 15px 20px 20px; border-radius: 10px; border-left: 5px solid #cc0000; box-shadow: 5px 7px 14px -5px rgba(0,0,0,0.15); width: 300px; display: flex; align-items: center; justify-content: space-between;";
              document.getElementById("voltage").innerHTML = "Voltage: " + 0 + "V";
              document.getElementById("ampere").innerHTML = "Ampere: " +  0 + "mA";
              document.getElementById("watt").innerHTML = "Watt: " +  0 + " mW";
              document.getElementById("vol").style = "--progress:" + 0;
              document.getElementById("amp").style = "--progress:" + 0;
              document.getElementById("wa").style = "--progress:" + 0;
              document.getElementById("vol").value = 0;
              document.getElementById("amp").value = 0;
              document.getElementById("wa").value = 0;
              document.getElementById("device").innerHTML = category;
              document.getElementById("display").style = "";
              document.getElementById("notice").innerHTML = "Your System Isn't Working! Please reach out to customer service!";
          }

          if (value2 >= 24) {
            document.getElementById("over-vol").innerHTML = "Over Voltage";
            document.getElementById("over-vol").style = "color: red"
          }
          else{
            document.getElementById("over-vol").innerHTML = "";
          }

          if (value3 >= 50) {
            document.getElementById("over-amp").innerHTML = "Over Ampere";
            document.getElementById("over-amp").style = "color: red"
          }
          else{
            document.getElementById("over-amp").innerHTML = "";
          }
        } 
          catch (error) {
          // If there is an error, display it on the webpage
          document.getElementById("voltage").innerHTML = error;
          document.getElementById("ampere").innerHTML = error;
          document.getElementById("watt").innerHTML = error;
          document.getElementById("vol").innerHTML = error;
          document.getElementById("amp").innerHTML = error;
          document.getElementById("wa").innerHTML = error;
        }
      }

      // Call the fetchData function every 2 seconds
      fetchData();
      setInterval(fetchData, 1000);