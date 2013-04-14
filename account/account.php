<?php 
  include_once('include/connect_db.php');
  $uid = $_SESSION['uid'];
  $name = $_SESSION['name'];
  
  $query = mysql_query("SELECT `full_name`, `email`, `pass`, `country`, `city`, `gender`, `birthday_day`, `birthday_month`, `birthday_year` 
                        FROM users   
                        WHERE `uid`='$uid'");
 
  if ($query) {
    $user = mysql_fetch_array($query);
  }
 ?>
  <script type='text/javascript' src="js/account.js"></script>
  <div id="title" class="account-title">Account Settings</div>
  <div class="account-message">Hello, <span class="strong"><?php echo $user['full_name']; ?></span>! This is your settings page, here you can change your account details.</div>
  <div class="account-profile-information-title">Profile Information</div>
  <form id="profile-information">
    <label for="full-name">Full name</label>
    <label for="country">Country</label>
    <label for="city" class="right-label">City</label>
    <input type="text" name="full-name" value="<?php echo $user['full_name']; ?>" class="account-full-name" />
    <input type="text" name="country" value="<?php echo !empty($user['country'])? $user['country'] : ''; ?>" placeholder="Your country..." class="account-country center-input" />
    <input type="text" name="city" value="<?php echo !empty($user['city'])? $user['city'] : ''; ?>" placeholder="Your city..." class="account-city right-input" />
    <label for="gender">Gender</label>
    <label for="birthday">Birthday</label>
    <select name="gender" class="account-gender">
      <?php 
        if (empty($user['gender'])) echo '<option value="">Your gender</option>';
      ?>
      <option value="female">Female</option>
      <option value="male">Male</option>
    </select>
    <select name="day" class="account-input-birthday">
      <?php
        if (empty($user['birthday_day'])) echo '<option value="">Enter day...</option>';
        for ($start = 1; $start < 32; $start++) {
          echo '<option value="' . $start . '">' . $start . '</option>';
        }
      ?>
    </select>
    
    <select name="month" class="account-input-birthday center-input" >
      <?php 
        if (empty($user['birthday_month'])) echo '<option value="">Enter month...</option>';
      ?>
      <option value="january">January</option>
      <option value="february">February</option>
      <option value="march">March</option>
      <option value="april">April</option>
      <option value="may">May</option>
      <option value="june">June</option>
      <option value="july">July</option>
      <option value="august">August</option>
      <option value="september">September</option>
      <option value="octomber">Octomber</option>
      <option value="november">November</option>
      <option value="december">December</option>
    </select>
    
    <select name="year" class="account-input-birthday right-input">
      <?php
        if (empty($user['birthday_year'])) echo '<option value="">Enter year...</option>';
        for ($start = date("Y"); $start > 1900; $start--) {
          echo '<option value="' . $start . '">' . $start . '</option>';
        }
      ?>
    </select>
    <input type="submit" name="user-update" value="Save Changes" class="account-submit" />
  </form>
  <?php   if (!empty($user['gender'])) { ?>
            <script>
              $("select[name='gender'] option[value='<?php echo $user['gender']; ?>']").attr("selected","selected");
            </script>
    <?php } 
    
          if (!empty($user['birthday_day'])) {  ?>
            <script>
              $("select[name='day'] option[value='<?php echo $user['birthday_day']; ?>']").attr("selected","selected");
            </script>
    <?php }
            
          if (!empty($user['birthday_month'])) { ?>
            <script>
              $("select[name='month'] option[value='<?php echo $user['birthday_month']; ?>']").attr("selected","selected");
            </script>
    <?php }
    
          if (!empty($user['birthday_year'])) { ?>
            <script>
              $("select[name='year'] option[value='<?php echo $user['birthday_year']; ?>']").attr("selected","selected");
            </script>
    <?php } ?>
    
    <div class="account-title account-subtitle">Social accounts</div>
      <?php $_SESSION['referer'] = 'linked_account'; ?>
      <div class="social-account-container">
      <a href="http://routinie.com/media-login/login_facebook.php"><div class="linked-account account-facebook"><img src="/images/facebook-account.png" /><p>Click to link your facebook account</p></div></a>
      <a href="http://routinie.com/media-login/login_google.php"><div class="linked-account account-google linked-account-right"><img src="/images/google-account.png" /><p>Click to link your google+ account</p></div></a>
      <!-- <div class="linked-account linked-account-right account-twitter"><img src="/images/twitter-account.png" /><p>Click to link your twitter account</p></div> -->
      <!-- <div class="linked-account account-linkedin"><img src="/images/linkedin-account.png" /><p>Click to link your linkedin account</p></div> -->
    </div>
    
    <div class="account-title account-subtitle">Email account</div>
    <div class="email-account-container">
    <label for="current-email">Current email</label>
    <label for="new-email">New email</label>
    <input type="text" class="account-current-email" name="current-email" value="<?php echo $user['email']; ?>" disabled="disabled"/>
    <input type="text" class="account-new-email" name="new-email" disabled="disabled"/>
    <input type="submit" name="user-update-email" value="Change Email" class="account-submit" />
    </div>
    <div class="account-title account-subtitle account-password">Change password</div>
    <div class="password-account-container">
    <label for="current-password">Current password</label>
    <label for="new-password" class="center-label">New password</label>
    <label for="retype-new-password" class="right-label">Retype new password</label>
    <input type="password" class="account-current-password" <?php echo empty($user['pass'])? 'placeholder="No password set" disabled="disabled" ' : ''; ?> name="current-password" />
    <?php if (empty($user['pass'])) echo '<input type="hidden" class="no-password" value="1" />'; ?>
    <input type="password" class="account-new-password center-input" name="new-password" />
    <input type="password" class="account-retype-new-password right-input" name="retype-new-password" />
    <input type="submit" name="user-update-password" value="Change password" class="account-submit" />
    </div>
    
    

    
    
    