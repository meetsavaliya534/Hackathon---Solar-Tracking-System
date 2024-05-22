      // Replace VIRTUAL_PIN with the virtual pin number you want to read from
      const virtualPin0 = "v0";
      const virtualPin1 = "v1";

      // Set up the Blynk API URL
      const apiUrl0 = `https://blr1.blynk.cloud/external/api/get?token=${authToken}&${virtualPin0}`;
      const apiUrl1 = `https://blr1.blynk.cloud/external/api/get?token=${authToken}&${virtualPin1}`;

      // Set up the fetch options
      const fetchOptions = {
        method: "GET",
        mode: "cors",
        cache: "no-cache"
      };

      // Fetch the data from the Blynk API
      async function fetchData() {
        try {
          const response0 = await fetch(apiUrl0, fetchOptions);
          const response1 = await fetch(apiUrl1, fetchOptions);

          const longitude = await response0.json();
          const latitude = await response1.json();


          // Extract the value from the response data
          const value0 = longitude;
          const value1 = latitude;

          //https://www.google.com/maps/embed/v1/view?key=AIzaSyDYHAtmiMZxzvHWEGDn-QIMfqGkE3qSNU8&center=${longitude},${latitude}
          const map = `https://www.google.com/maps/dir//${longitude}+${latitude}/@${longitude},${latitude},16z`;
          const mapsrc = `https://www.google.com/maps/embed/v1/view?key=${key}&center=${longitude},${latitude}&zoom=20`;

          // Display the value on the webpage
          document.getElementById("longitude").innerHTML = value0;
          document.getElementById("latitude").innerHTML = value1;
          const link = document.getElementById("map");
          link.href = map;
          document.getElementById("mapsrc").src = mapsrc;
        } 
          catch (error) {
          // If there is an error, display it on the webpage
          document.getElementById("longitude").innerHTML = error;
          document.getElementById("latitude").innerHTML = error;
          document.getElementById("map").innerHTML = error;
        }
      }

      // Call the fetchData function
      fetchData();
      // Call the fetchData function every 5 seconds
      //setInterval(fetchData, 5000);