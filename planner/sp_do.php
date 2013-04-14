<?php
session_start();
echo '<script> $(function() {';
foreach($_SESSION['sp_subcats'] as $cat) {
  echo '$("._sp_' . $cat . '").removeClass("hide");';
}
echo '$(".category-question.hide").remove();';
?>
});
</script>
<script type='text/javascript' src="../js/planner.js"></script>
<div class="unselectable">
<div class="category-question hide _sp_books" sid="1">
  <div class="planner-question-title">Books</div>
  <div class="planner-question-text">
    How would you like to measure this?<br>
    <input type="checkbox" name="sp-books-time-spend" value="1" class="sp-checkbox-input" /><div class="sp-books-time-spend sp-checkbox unselectable">Time spend</div>
    <input type="checkbox" name="sp-books-pages" value="1" class="sp-checkbox-input" /><div class="sp-books-pages sp-checkbox unselectable">Pages</div>
    <input type="checkbox" name="sp-books-both" value="1" class="sp-checkbox-input" /><div class="sp-books-both sp-checkbox unselectable">Both</div>
    <div class="sp-question sp-question-books-time-spend hide">
       How much time would you like to read?<br>
       <input type="text" name="sp-books-time-hour" class="sp-data" data="time" placeholder="hours">
    </div>
    <div class="sp-question sp-question-books-pages hide">
       How many pages would you like to read?<br>
       <input type="text" name="sp-books-time-hour" class="sp-data" data="page" placeholder="pages">
    </div>
    <div class="clearfix"></div>
  </div>
  
</div>

<div class="category-question hide _sp_courses" sid="2">
  <div class="planner-question-title">Courses</div>
  <div class="planner-question-text">
    <div class="sp-question sp-question-courses-time-spend">
       How much time would you like to read or listen?<br>
       <input type="text" name="sp-courses-time-hour" class="sp-data" data="time" placeholder="hours">
    </div>
    <div class="clearfix"></div>
  </div>
  
</div>

<div class="category-question hide _sp_tutorials" sid="3">
  <div class="planner-question-title">Tutorials</div>
  <div class="planner-question-text">
    <div class="sp-question sp-question-tutorials-time-spend">
       How much time would you like to read or listen?<br>
       <input type="text" name="sp-tutorials-time-hour" class="sp-data" data="time" placeholder="hours">
    </div>
    <div class="clearfix"></div>
  </div>
  
</div>

<div class="category-question hide _sp_experiments" sid="4">
  <div class="planner-question-title">Experiments</div>
  <div class="planner-question-text">
    <div class="sp-question sp-question-experiments-time-spend">
       How much time would you like to do experiments?<br>
       <input type="text" name="sp-experiments-time-hour" class="sp-data" data="time" placeholder="hours">
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="category-question hide _sp_research" sid="5">
  <div class="planner-question-title">Research</div>
  <div class="planner-question-text">
    <div class="sp-question sp-question-research-time-spend">
       How much time would you like to do research?<br>
       <input type="text" name="sp-research-time-hour" class="sp-data" data="time" placeholder="hours">
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="category-question hide _sp_work" sid="6">
  <div class="planner-question-title">Work</div>
  <div class="planner-question-text">
    <div class="sp-question sp-question-work-time-spend">
       How much time would you like to work?<br>
       <input type="text" name="sp-work-time-hour" class="sp-data" data="time" placeholder="hours">
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="category-question hide _sp_projects" sid="7">
  <div class="planner-question-title">Projects</div>
  <div class="planner-question-text">
    <div class="sp-question sp-question-projects-time-spend">
       How much time do you want to spend doing projects?<br>
       <input type="text" name="sp-projects-time-hour" class="sp-data" data="time" placeholder="hours">
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="category-question hide _sp_contracts" sid="8">
  <div class="planner-question-title">Contracts</div>
  <div class="planner-question-text">
    <div class="sp-question sp-question-contracts-time-spend">
       How much time do you want to spend doing contracts?<br>
       <input type="text" name="sp-contracts-time-hour" class="sp-data" data="time" placeholder="hours">
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="category-question hide _sp_sports" sid="9">
  <div class="planner-question-title">Sports</div>
  <div class="planner-question-text">
    How would you like to measure this?<br>
    <input type="checkbox" name="sp-sports-time-spend" value="1" class="sp-checkbox-input" /><div class="sp-sports-time-spend sp-checkbox unselectable">Games</div>
    <input type="checkbox" name="sp-sports-pages" value="1" class="sp-checkbox-input" /><div class="sp-sports-pages sp-checkbox unselectable">Time</div>
    <input type="checkbox" name="sp-sports-both" value="1" class="sp-checkbox-input" /><div class="sp-sports-both sp-checkbox unselectable">Both</div>
    <div class="sp-question sp-question-sports-time-spend hide">
       How many games would you like to play?<br>
       <input type="text" name="sp-sports-time-hour" class="sp-data" data="game" placeholder="games">
    </div>
    <div class="sp-question sp-question-sports-pages hide">
       How mamy hours would you like to play?<br>
       <input type="text" name="sp-sports-time-hour" class="sp-data" data="time" placeholder="hours">
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="category-question hide _sp_diet" sid="10">
  <div class="planner-question-title">Diet</div>
  <div class="planner-question-text">
    <div class="sp-question sp-question-diet-time-spend">
       How much ....................... diet ?<br>
       <input type="text" name="sp-diet-quantity" class="sp-data" data="quantity" placeholder="quantity">
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="category-question hide _sp_walking" sid="11">
  <div class="planner-question-title">Walking</div>
  <div class="planner-question-text">
    How would you like to measure this?<br>
    <input type="checkbox" name="sp-walking-time-spend" value="1" class="sp-checkbox-input" /><div class="sp-walking-time-spend sp-checkbox unselectable">Time</div>
    <input type="checkbox" name="sp-walking-pages" value="1" class="sp-checkbox-input" /><div class="sp-walking-pages sp-checkbox unselectable">Distance</div>
    <input type="checkbox" name="sp-walking-both" value="1" class="sp-checkbox-input" /><div class="sp-walking-both sp-checkbox unselectable">Both</div>
    <div class="sp-question sp-question-walking-time-spend hide">
       How much time would you like to walk?<br>
       <input type="text" name="sp-walking-time-hour" class="sp-data" data="time" placeholder="minutes">
    </div>
    <div class="sp-question sp-question-walking-pages hide">
       How many km would you like to walk?<br>
       <input type="text" name="sp-walking-time-hour" class="sp-data" data="distance" placeholder="km">
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="category-question hide _sp_jogging" sid="12">
  <div class="planner-question-title">Jogging</div>
  <div class="planner-question-text">
    How would you like to measure this?<br>
    <input type="checkbox" name="sp-jogging-time-spend" value="1" class="sp-checkbox-input" /><div class="sp-jogging-time-spend sp-checkbox unselectable">Time</div>
    <input type="checkbox" name="sp-jogging-pages" value="1" class="sp-checkbox-input" /><div class="sp-jogging-pages sp-checkbox unselectable">Distance</div>
    <input type="checkbox" name="sp-jogging-both" value="1" class="sp-checkbox-input" /><div class="sp-jogging-both sp-checkbox unselectable">Both</div>
    <div class="sp-question sp-question-jogging-time-spend hide">
       How much time would you like to jogging?<br>
       <input type="text" name="sp-jogging-time-hour" class="sp-data" data="time" placeholder="minutes">
    </div>
    <div class="sp-question sp-question-jogging-pages hide">
       How many km would you like to jogging?<br>
       <input type="text" name="sp-jogging-time-hour" class="sp-data" data="distance" placeholder="km">
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="category-question hide _sp_traveling" sid="13">
  <script>
   $(function() {
       $( "#from" ).datepicker({
           defaultDate: "+1d",
           changeMonth: true,
           numberOfMonths: 1,
           onClose: function( selectedDate ) {
               $( "#to" ).datepicker( "option", "minDate", selectedDate );
           }
       });
       $( "#to" ).datepicker({
           defaultDate: "+2d",
           changeMonth: true,
           numberOfMonths: 1,
           onClose: function( selectedDate ) {
               $( "#from" ).datepicker( "option", "maxDate", selectedDate );
           }
       });
   });
  </script>
  <div class="planner-question-title">Traveling</div>
  <div class="planner-question-text">
    <div class="sp-question sp-question-traveling-time-spend">
       Where would you like to travel and when?<br>
       <label for="sp-traveling-continent">Continent</label>
       <label for="sp-traveling-continent">Country</label>
       <label for="sp-traveling-continent">Place</label>
       <label for="sp-traveling-start">Start</label>
       <label for="sp-traveling-end">End</label><br>
       <input type="text" name="sp-traveling-input-continent" class="sp-data" data="continent" placeholder="continent" />
       <input type="text" name="sp-traveling-input-country" class="sp-data" data="country" placeholder="country" />
       <input type="text" name="sp-traveling-input-place" class="sp-data" data="place" placeholder="place" />
       <input type="text" id="from" name="sp-traveling-input-start" class="sp-data" data="start" placeholder="start" />
       <input type="text" id="to" name="sp-traveling-input-end" class="sp-data" data="end" placeholder="end" />

    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="category-question hide _sp_hobbies" sid="14">
  <div class="planner-question-title">Hobbies</div>
  <div class="planner-question-text">
    <div class="sp-question sp-question-hobbies-time-spend">
       How much time do you want to spend with your hobbies?<br>
       <input type="text" name="sp-hobbies-quantity" class="sp-data" data="time" placeholder="minutes">
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="category-question hide _sp_volunteering" sid="15">
  <div class="planner-question-title">Volunteering</div>
  <div class="planner-question-text">
    <div class="sp-question sp-question-volunteering-time-spend">
       How much time do you want to spend doing voluntary work?<br>
       <input type="text" name="sp-volunteering-quantity" class="sp-data" data="time" placeholder="minutes">
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="category-question hide _sp_relationships" sid="16">
  <div class="planner-question-title">Relationships</div>
  <div class="planner-question-text">
    <div class="sp-question sp-question-relationships-time-spend">
       With who, where and when do you want to spend this time?<br>
       <label for="sp-relationships-who">With who</label>
       <label for="sp-relationships-where">Where</label>
       <label for="sp-relationships-time">How much time</label><br>
       <input type="text" name="sp-relationships-input-who" class="sp-data" data="with" />
       <input type="text" name="sp-relationships-input-where" class="sp-data" data="where" placeholder="place" />
       <input type="text" name="sp-relationships-input-time" class="sp-data" data="time" placeholder="minutes" />

    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="category-question hide _sp_friends" sid="17">
  <div class="planner-question-title">Friends</div>
  <div class="planner-question-text">
    <div class="sp-question sp-question-friends-time-spend">
       With who, where and when do you want to spend this time?<br>
       <label for="sp-friends-who">With who</label>
       <label for="sp-friends-where">Where</label>
       <label for="sp-friends-time">How much time</label><br>
       <input type="text" name="sp-friends-input-who" class="sp-data" data="with"/>
       <input type="text" name="sp-friends-input-where" class="sp-data" data="where" placeholder="place" />
       <input type="text" name="sp-friends-input-time" class="sp-data" data="time" placeholder="minutes" />

    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="category-question hide _sp_family" sid="18">
  <div class="planner-question-title">Family</div>
  <div class="planner-question-text">
    <div class="sp-question sp-question-family-time-spend">
       With who, where and when do you want to spend this time?<br>
       <label for="sp-family-who">With who</label>
       <label for="sp-family-where">Where</label>
       <label for="sp-family-time">How much time</label><br>
       <input type="text" name="sp-family-input-who" class="sp-data" data="with" />
       <input type="text" name="sp-family-input-where" class="sp-data" data="where" placeholder="place" />
       <input type="text" name="sp-family-input-time" class="sp-data" data="time" placeholder="minutes" />
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="category-question hide _sp_television" sid="19">
  <div class="planner-question-title">Television</div>
  <div class="planner-question-text">
    How would you like to measure this?<br>
    <input type="checkbox" name="sp-television-time-spend" value="1" class="sp-checkbox-input" /><div class="sp-television-time-spend sp-checkbox unselectable">Time</div>
    <input type="checkbox" name="sp-television-pages" value="1" class="sp-checkbox-input" /><div class="sp-television-pages sp-checkbox unselectable">TV Shows</div>
    <input type="checkbox" name="sp-television-both" value="1" class="sp-checkbox-input" /><div class="sp-television-both sp-checkbox unselectable">Both</div>
    <div class="sp-question sp-question-television-time-spend hide">
       How much time do you want to spend watching TV?<br>
       <input type="text" name="sp-television-time-hour" class="sp-data" data="time" placeholder="minutes">
    </div>
    <div class="sp-question sp-question-television-pages hide">
       What TV shows would you like to watch?<br>
       <input type="text" name="sp-television-time-hour" class="sp-data" data="television" placeholder="show">
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="category-question hide _sp_movies" sid="20">
  <div class="planner-question-title">Movies</div>
  <div class="planner-question-text">
    How would you like to measure this?<br>
    <input type="checkbox" name="sp-movies-time-spend" value="1" class="sp-checkbox-input" /><div class="sp-movies-time-spend sp-checkbox unselectable">Time</div>
    <input type="checkbox" name="sp-movies-pages" value="1" class="sp-checkbox-input" /><div class="sp-movies-pages sp-checkbox unselectable">Movies</div>
    <input type="checkbox" name="sp-movies-both" value="1" class="sp-checkbox-input" /><div class="sp-movies-both sp-checkbox unselectable">Both</div>
    <div class="sp-question sp-question-movies-time-spend hide">
       How much time do you want to spend watching movies?<br>
       <input type="text" name="sp-movies-time-hour" class="sp-data" data="time" placeholder="minutes">
    </div>
    <div class="sp-question sp-question-movies-pages hide">
       What movies would you like to watch?<br>
       <input type="text" name="sp-movies-time-hour" class="sp-data" data="movie" placeholder="movies">
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="category-question hide _sp_music" sid="21">
  <div class="planner-question-title">Music</div>
  <div class="planner-question-text">
    How would you like to measure this?<br>
    <input type="checkbox" name="sp-music-time-spend" value="1" class="sp-checkbox-input" /><div class="sp-music-time-spend sp-checkbox unselectable">Time</div>
    <input type="checkbox" name="sp-music-pages" value="1" class="sp-checkbox-input" /><div class="sp-music-pages sp-checkbox unselectable">Music</div>
    <input type="checkbox" name="sp-music-both" value="1" class="sp-checkbox-input" /><div class="sp-music-both sp-checkbox unselectable">Both</div>
    <div class="sp-question sp-question-music-time-spend hide">
       How much time do you want to spend listening music?<br>
       <input type="text" name="sp-music-time-hour" class="sp-data" data="time" placeholder="minutes">
    </div>
    <div class="sp-question sp-question-music-pages hide">
       What music would you like to listen?<br>
       <input type="text" name="sp-music-time-hour" class="sp-data" data="music" placeholder="music">
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="category-question hide _sp_games" sid="22">
  <div class="planner-question-title">Games</div>
  <div class="planner-question-text">
    How would you like to measure this?<br>
    <input type="checkbox" name="sp-games-time-spend" value="1" class="sp-checkbox-input" /><div class="sp-games-time-spend sp-checkbox unselectable">Time</div>
    <input type="checkbox" name="sp-games-pages" value="1" class="sp-checkbox-input" /><div class="sp-games-pages sp-checkbox unselectable">Games</div>
    <input type="checkbox" name="sp-games-both" value="1" class="sp-checkbox-input" /><div class="sp-games-both sp-checkbox unselectable">Both</div>
    <div class="sp-question sp-question-games-time-spend hide">
       How much time would you like to spend playing games?<br>
       <input type="text" name="sp-games-time-hour" class="sp-data" data="time" placeholder="minutes">
    </div>
    <div class="sp-question sp-question-games-pages hide">
       What game would you like to play?<br>
       <input type="text" name="sp-games-time-hour" class="sp-data" data="game" placeholder="game">
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="category-question hide _sp_income" sid="23">
  <div class="planner-question-title">Income</div>
  <div class="planner-question-text">
    <div class="sp-question sp-question-income-time-spend">
      How much money do you want to earn?<br>
      <input type="text" name="sp-income-quantity" class="sp-data" data="amount" placeholder="money">
      <select name="currency" class="sp-money sp-data" data="currency">
        <option value="euro">EUR</option>
        <option value="dollars">USD</option>
        <option value="ron">RON</option>
      </select>
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="category-question hide _sp_expenses" sid="24">
  <div class="planner-question-title">Expenses</div>
  <div class="planner-question-text">
    <div class="sp-question sp-question-expenses-time-spend">
       How much money do you want to spend?<br>
       <input type="text" name="sp-expenses-quantity" class="sp-data" data="amount" placeholder="money">
        <select name="currency" class="sp-money sp-data" data="currency">
          <option value="euro">EUR</option>
          <option value="dollars">USD</option>
          <option value="ron">RON</option>
      </select>
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="category-question hide _sp_donations" sid="25">
  <div class="planner-question-title">Donations</div>
  <div class="planner-question-text">
    <div class="sp-question sp-question-donations-time-spend">
       How much money do you want to donate?<br>
       <input type="text" name="sp-donations-quantity" class="sp-data" data="amount" placeholder="money">
        <select name="currency" class="sp-money sp-data" data="currency">
          <option value="euro">EUR</option>
          <option value="dollars">USD</option>
          <option value="ron">RON</option>
      </select>
    </div>
    <div class="clearfix"></div>
  </div>
</div>

</div>
<div class="sp-save">Save this plan!</div>