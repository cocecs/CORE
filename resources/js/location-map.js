const APP = {
  TOKEN: 'pk.f6c8dcfd6ae6786bc8a832a1fe008217',
  AUTOCOMPLETEURL: `https://api.locationiq.com/v1/autocomplete?format=json&`, // Note the api. location subdomain
  MAPURL: `https://maps.locationiq.com/v3/staticmap?`,
  data: null,
  debounceTimer: null,

  init: () => {
    const inputField = document.getElementById('place_of_work');

    // Listen for typing events to handle autocompletion
    inputField.addEventListener('input', (e) => {
      APP.debounce(() => APP.doAutocomplete(e.target.value), 300);
    });

    // Listen for selection or manual form submission
    document.getElementById('locationForm').addEventListener('submit', APP.handleSubmit);
  },

  // Helper function to stop rapid API requests while typing
  debounce: (callback, delay) => {
    clearTimeout(APP.debounceTimer);
    APP.debounceTimer = setTimeout(callback, delay);
  },

  doAutocomplete: (query) => {
    let q = query.trim();
    if (q.length < 3) return; // Don't search until the user types at least 3 characters

    let url = `${APP.AUTOCOMPLETEURL}key=${APP.TOKEN}&q=${q}&limit=5`;

    fetch(url)
      .then((resp) => {
        if (!resp.ok) throw new Error(resp.statusText);
        return resp.json();
      })
      .then((suggestions) => {
        APP.renderSuggestions(suggestions);
      })
      .catch((err) => console.error('Autocomplete error:', err));
  },

  renderSuggestions: (suggestions) => {
    const dataList = document.getElementById('autocomplete-results');
    dataList.innerHTML = ''; // Clear old suggestions

    suggestions.forEach((item) => {
      let option = document.createElement('option');
      // Store coordinate details right inside the data attribute
      option.value = item.display_name;
      option.setAttribute('data-lat', item.lat);
      option.setAttribute('data-lon', item.lon);
      dataList.appendChild(option);
    });
  },

  handleSubmit: (ev) => {
    ev.preventDefault(); // Pause the standard submission form line

    const inputValue = document.getElementById('place_of_work').value;
    const options = document.querySelectorAll('#autocomplete-results option');
    let selectedPlace = null;

    // Find the option matching what the user selected/typed
    options.forEach((option) => {
      if (option.value === inputValue) {
        selectedPlace = {
          lat: option.getAttribute('data-lat'),
          lon: option.getAttribute('data-lon'),
          display_name: option.value
        };
      }
    });

    if (selectedPlace) {
      APP.data = selectedPlace;

      // Inject coordinates into the hidden fields for Laravel route handling
      document.getElementById('latitude').value = selectedPlace.lat;
      document.getElementById('longitude').value = selectedPlace.lon;

      // Update static map preview visually
      APP.getMap();

      // Submit form directly to Laravel back-end safely
      ev.target.submit();
    } else {
      alert('Please select a valid address from the autocompleted dropdown list.');
    }
  },

  getMap: () => {
    if (!APP.data) return false;
    let lon = APP.data.lon;
    let lat = APP.data.lat;
    let url = `${APP.MAPURL}key=${APP.TOKEN}&center=${lat},${lon}&zoom=14&size=400x300&format=png`;
    APP.showMap(url);
  },

  showMap: (url) => {
    let section = document.querySelector('.map');
    let img = section.querySelector('img');
    if (!img) {
      img = document.createElement('img');
      img.className = "w-full max-w-md h-auto rounded-md shadow-md border border-gray-200 mt-4 mx-auto";
      section.append(img);
    }
    img.alt = APP.data.display_name;
    img.src = url;
  },
};

document.addEventListener('DOMContentLoaded', APP.init);
