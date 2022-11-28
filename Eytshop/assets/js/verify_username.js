function verify_username() {
    let pass = document.querySelector('#username').value;
  
    // Length
    if (pass.length < 8 || pass.length > 15) {
      document.querySelector('#verification_status').innerHTML = 'Password length is not good';
      document.querySelector('#verification_status').classList.remove('status-success');
      document.querySelector('#verification_status').classList.add('status-error');
      return false;
    }
  
    // Lowercase
    let lowerCase = 'abcdefghijklmnopqrstuvwxyz';
    let found = false;
    for (let i = 0; i < pass.length; i++) {
      let c = pass.charAt(i);
      if (lowerCase.includes(c)) {
        found = true;
        break;
      }
    }
    if (!found) {
      document.querySelector('#verification_status').innerHTML = 'No lowercase letter';
      document.querySelector('#verification_status').classList.remove('status-success');
      document.querySelector('#verification_status').classList.add('status-error');
      return false;
    }
  
    // Uppercase
    let upperCase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    found = false;
    for (let i = 0; i < pass.length; i++) {
      let c = pass.charAt(i);
      if (upperCase.includes(c)) {
        found = true;
        break;
      }
    }
    if (!found) {
      document.querySelector('#verification_status').innerHTML = 'No uppercase letter';
      document.querySelector('#verification_status').classList.remove('status-success');
      document.querySelector('#verification_status').classList.add('status-error');
      return false;
    }

    // Digit
    let digit = '0123456789';
    found = false;
    for (let i = 0; i < pass.length; i++) {
      let c = pass.charAt(i);
      if (digit.includes(c)) {
        found = true;
        break;
      }
    }
    if (!found) {
      document.querySelector('#verification_status').innerHTML = 'No digit';
      document.querySelector('#verification_status').classList.remove('status-success');
      document.querySelector('#verification_status').classList.add('status-error');
      return false;
    }}