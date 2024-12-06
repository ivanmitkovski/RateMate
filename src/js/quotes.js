"use strict";

const placeholder = document.querySelector("#tagline");

if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(
    (position) => {
      const latitude = position.coords.latitude;
      const longitude = position.coords.longitude;
      console.log(`Latitude: ${latitude}, Longitude: ${longitude}`);

      const apiUrl = `https://api.api-ninjas.com/v1/airquality?lat=${latitude}&lon=${longitude}`;

      fetch(apiUrl, {
        headers: { "X-Api-Key": "jyg3I/RPytZ/SbmQ7H1shQ==0Wd7MobEfxeibEYP" },
      })
        .then((response) => response.json())
        .then((data) => {
          placeholder.textContent = `Air Quality: ${data.overall_aqi} 🌬️`;
          console.log(data);
        })
        .catch((error) => {
          console.error("Error fetching air quality data:", error);
        });
    },
    (error) => {
      console.error("Error occurred during geolocation:", error.message);
    }
  );
} else {
  console.error("Geolocation is not supported by this browser.");
}
