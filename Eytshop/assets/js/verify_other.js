function verify_other() {
    let pass = document.querySelector('#business_name', '#bussiness_address', '#address', '#full_name').value;
  
    // Length
    if (pass.length > 5) {
      document.querySelector('#verification_status').innerHTML = 'Your length is not good';
      document.querySelector('#verification_status').classList.remove('status-success');
      document.querySelector('#verification_status').classList.add('status-error');
      return false;
    }
}