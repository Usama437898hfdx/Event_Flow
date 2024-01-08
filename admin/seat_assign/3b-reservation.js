var reserve = {
  // (A) CHOOSE THIS SEAT
  toggle : seat => seat.classList.toggle("selected"),

  // (B) SAVE RESERVATION
  save : (c) => {
    // (B1) GET SELECTED SEATS
    var selected = document.querySelectorAll("#layout .selected");

    // (B2) ERROR!
    if (selected.length == 0) { alert("No seats selected."); }
    
    else if(selected.length > c){
      alert("You cannot select more than "+c);
    }
    else if(selected.length < c){
      alert("You cannot select less than "-c);
    }
    // (B3) NINJA FORM SUBMISSION
    else {
      var ninja = document.getElementById("ninja");
      for (let seat of selected) {
        let input = document.createElement("input");
        input.type = "hidden";
        input.name = "seats[]";
        input.value = seat.innerHTML;
        ninja.appendChild(input);
      }
      ninja.submit();
    }
  }
};