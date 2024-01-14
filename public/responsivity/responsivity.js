function ajax_post_request(
  endpoint,
  query,
  done_callback = null,
  fail_callback = null
) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    if (done_callback !== null) {
      done_callback(this.responseText);
    }
  };
  xhttp.onerror = function (error) {
    if (fail_callback !== null) {
      fail_callback(error);
    }
  };
  xhttp.open("POST", endpoint);
  xhttp.send(query);
}

class PopUpInfo extends HTMLElement {
  constructor() {
    // Always call super first in constructor
    super();

    // write element functionality in here
  }

  connectedCallback() {
    //this.addEventListener("click", this.onclick);

  }
}





