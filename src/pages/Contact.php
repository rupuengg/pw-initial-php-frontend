<div class="conatainer">
  <div class="bannerBox">
    <div class="bannerItem">
      <div
        class="slideItem"
        style="
          background-image: url('https://ik.imagekit.io/yz7i3lbbn/assets/banner/banner1.jpg');
        "
      ></div>
    </div>
    <div class="bannerItem">
      <div
        class="slideItem"
        style="
          background-image: url('https://ik.imagekit.io/yz7i3lbbn/assets/banner/banner2.jpg');
        "
      ></div>
    </div>
    <div class="bannerItem">
      <div
        class="slideItem"
        style="
          background-image: url('https://ik.imagekit.io/yz7i3lbbn/assets/banner/banner3.jpg');
        "
      ></div>
    </div>
    <div class="bannerItem">
      <div
        class="slideItem"
        style="
          background-image: url('https://ik.imagekit.io/yz7i3lbbn/assets/banner/banner4.jpg');
        "
      ></div>
    </div>
    <div class="bannerItem active">
      <div
        class="slideItem"
        style="
          background-image: url('https://ik.imagekit.io/yz7i3lbbn/assets/banner/banner5.jpg');
        "
      ></div>
    </div>
  </div>
  <div class="siteCssWidth1200">
    <div class="enquire marginTop100 marginBottom100">
      <div class="form-layouts">
        <h1 class="header1">Enquire for services</h1>
        <p class="success" style="display:none;">Your request has been sent</p>
        <div class="form-field marginTop20">
          <label>Name</label>
          <div class="field-box"><input name="name" value="" /></div>
          <span class="name error" style="display:none;">Mandatory<span>
        </div>
        <div class="form-field marginTop20">
          <label>Phone no</label>
          <div class="field-box"><input name="phone" value="" /></div>
          <span class="phone error" style="display:none;">Mandatory<span>
        </div>
        <div class="form-field marginTop20">
          <label>Email</label>
          <div class="field-box"><input name="email" value="" /></div>
          <span class="email error" style="display:none;">Mandatory<span>
        </div>
        <div class="form-field marginTop20">
          <label>Query</label>
          <div class="field-box">
            <textarea name="query" rows="4"></textarea>
            <span class="query error" style="display:none;">Mandatory<span>
          </div>
        </div>
        <div class="form-field marginTop20">
          <div id="submitContactRequest" class="button"><button type="button">Submit</button></div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  window.onload = function() {
    document.getElementById('submitContactRequest').addEventListener('click', function() {
      const name = document.querySelector('input[name="name"]').value;
      const phone = document.querySelector('input[name="phone"]').value;
      const email = document.querySelector('input[name="email"]').value;
      const query = document.querySelector('textarea[name="query"]').value;

      document.querySelector('span.name.error').setAttribute('style', 'display:none;');
      document.querySelector('span.phone.error').setAttribute('style', 'display:none;');
      document.querySelector('span.email.error').setAttribute('style', 'display:none;');
      document.querySelector('span.query.error').setAttribute('style', 'display:none;');

      if(name.trim() === "") document.querySelector('span.name.error').setAttribute('style', 'display:block;');
      if(phone.trim() === "") document.querySelector('span.phone.error').setAttribute('style', 'display:block;');
      if(email.trim() === "") document.querySelector('span.email.error').setAttribute('style', 'display:block;');
      if(query.trim() === "") document.querySelector('span.query.error').setAttribute('style', 'display:block;');

      fetch('<?php echo API_HOST; ?>/query', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ name, phone, email, query })
      })
      .then(response => {
        document.querySelector('p.success').setAttribute('style', 'display:block;');
        document.querySelector('input[name="name"]').value = '';
        document.querySelector('input[name="phone"]').value = '';
        document.querySelector('input[name="email"]').value = '';
        document.querySelector('textarea[name="query"]').value = '';
        
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        console.log('Success:', data);
      })
      .catch(error => {
        console.error('Error:', error);
      });
    });
  }
</script>