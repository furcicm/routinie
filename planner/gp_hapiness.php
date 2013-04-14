<?php
  require_once("gen_plan_inc.php");
?>
<script>
  $('.general-menu-item').removeClass('menu-item-selected');
  $('.menu-item-hapiness').addClass('menu-item-selected');
</script>
<div class="planner-happiness-container">
  
  <!-- Question nr. 1 -->
  <div class="category-question">
    <div class="planner-question-title">Time for personal development</div>
    <div class="planner-question-text">Time spent for personal development</div>
    <div class="planner-answer-container">
      <div class="planner-answer-current">
        <div class="planner-answer-title">Now</div>
        <select name="select-now" class="category-select answer-now">
          <option value="1">No</option>
          <option value="2">&lt;1 hr</option>
          <option value="3">1-2 hrs</option>
          <option value="4">More</option>
        </select>
      </div>
      <div class="planner-answer-goal">
        <div class="planner-answer-title">After <span class="year"></span> years.</div>
        <select name="select-now" class="category-select answer-after">
          <option value="1">No</option>
          <option value="2">&lt;1 hr</option>
          <option value="3">1-2 hrs</option>
          <option value="4">More</option>
        </select>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  
  <!-- Question nr. 2 -->
  <div class="category-question">
    <div class="planner-question-title">Personal Sacrifice for Others</div>
    <div class="planner-question-text">Personal Sacrifice for Others</div>
    <div class="planner-answer-container">
      <div class="planner-answer-current">
        <div class="planner-answer-title">Now</div>
        <select name="select-now" class="category-select answer-now">
          <option value="1">No</option>
          <option value="2">Rarely</option>
          <option value="3">Often</option>
          <option value="4">Always</option>
        </select>
      </div>
      <div class="planner-answer-goal">
        <div class="planner-answer-title">After <span class="year"></span> years.</div>
        <select name="select-now" class="category-select answer-after">
          <option value="1">No</option>
          <option value="2">Rarely</option>
          <option value="3">Often</option>
          <option value="4">Always</option>
        </select>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  
  <!-- Question nr. 3 -->
  <div class="category-question">
    <div class="planner-question-title">Who do you compare yourself with?</div>
    <div class="planner-question-text">Who do you compare yourself with?</div>
    <div class="planner-answer-container">
      <div class="planner-answer-current">
        <div class="planner-answer-title">Now</div>
        <select name="select-now" class="category-select answer-now">
          <option value="1">No one</option>
          <option value="2">The best in my field</option>
          <option value="3">The ideal</option>
          <option value="4">Me &#40;from the past&#41;</option>
        </select>
      </div>
      <div class="planner-answer-goal">
        <div class="planner-answer-title">After <span class="year"></span> years.</div>
        <select name="select-now" class="category-select answer-after">
          <option value="1">No one</option>
          <option value="2">The best in my field</option>
          <option value="3">The ideal</option>
          <option value="4">Me &#40;from the past&#41;</option>
        </select>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  
  <!-- Question nr. 4 -->
  <div class="category-question">
    <div class="planner-question-title">Forgiveness</div>
    <div class="planner-question-text">Forgiveness</div>
    <div class="planner-answer-container">
      <div class="planner-answer-current">
        <div class="planner-answer-title">Now</div>
          <select name="select-now" class="category-select answer-now">
            <option value="1">I`m ok with everyone</option>
            <option value="2">1-2</option>
            <option value="3">3-5</option>
            <option value="4">More</option>
        </select>
      </div>
      <div class="planner-answer-goal">
        <div class="planner-answer-title">After <span class="year"></span> years.</div>
          <select name="select-after" class="category-select answer-after">
            <option value="1">I`m ok with everyone</option>
            <option value="2">1-2</option>
            <option value="3">3-5</option>
            <option value="4">More</option>
        </select>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  
  <!-- Question nr. 5 -->
  <div class="category-question">
    <div class="planner-question-title">Value in work</div>
    <div class="planner-question-text">Value in work</div>
    <div class="planner-answer-container">
      <div class="planner-answer-current">
        <div class="planner-answer-title">Now</div>
          <select name="select-now" class="category-select answer-now">
            <option value="1">0</option>
            <option value="2">25&#37;</option>
            <option value="3">50&#37;</option>
            <option value="4">75&#37;</option>
            <option value="5">I do what I love &amp; I`m good at it!</option>
        </select>
      </div>
      <div class="planner-answer-goal">
        <div class="planner-answer-title">After <span class="year"></span> years.</div>
          <select name="select-after" class="category-select answer-after">
            <option value="1">0</option>
            <option value="2">25&#37;</option>
            <option value="3">50&#37;</option>
            <option value="4">75&#37;</option>
            <option value="5">I do what I love &amp; I`m good at it!</option>
        </select>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  
</div> 

<a href="/?q=general-planner/finances"><div class="planner-next-step">Next Step</div></a>