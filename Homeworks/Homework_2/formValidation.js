const months = {
  JANUARY: 1,
  FEBRUARY: 2,
  MARCH: 3,
  APRIL: 4,
  MAY: 5,
  JUNE: 6,
  JULY: 7,
  AUGUST: 8,
  SEPTEMBER: 9,
  OCTOBER: 10,
  NOVEMBER: 11,
  DECEMBER: 12,
};

const zodiacs = {
  SAGITTARIUS: "Sagittarius",
  CAPRICORN: "Capricorn",
  AQUARIUS: "Aquarius",
  PISCES: "Pisces",
  ARIES: "Aries",
  TAURUS: "Taurus",
  GEMINI: "Gemini",
  CANCER: "Cancer",
  LEO: "Leo",
  VIRGO: "Virgo",
  LIBRA: "Libra",
  SCORPIO: "Scorpio",
};

function isFormValid() {
  return (
    isFirstnameValid() &&
    isLastnameValid() &&
    isCourseValid() &&
    isSpecialtyValid() &&
    isFacultyNumberValid() &&
    isGroupValid()
  );
}

function isFirstnameValid() {
  if (!document.getElementById("firstname").value.match(/^[A-Z][a-z]{1,20}/)) {
    document.getElementById("firstnameError").innerHTML =
      "Please insert correct firstname without any special signs!";
    return false;
  }
  document.getElementById("firstnameError").innerHTML = "";
  return true;
}

function isLastnameValid() {
  if (!document.getElementById("lastname").value.match(/^[A-Z][a-z-]{3,25}/)) {
    document.getElementById("lastnameError").innerHTML =
      "Please insert correct lastname without any special signs!";
    return false;
  }
  document.getElementById("lastnameError").innerHTML = "";
  return true;
}

function isCourseValid() {
  if (!document.getElementById("course").value.match(/^[1-6]$/)) {
    document.getElementById("courseError").innerHTML =
      "Please insert a number which represents your academic year!";
    return false;
  }
  document.getElementById("courseError").innerHTML = "";
  return true;
}

function isSpecialtyValid() {
  if (!document.getElementById("specialty").value.match(/^[A-Z][a-z-]{1,50}/)) {
    document.getElementById("specialtyError").innerHTML =
      "Please insert correct specialty name without any special signs!";
    return false;
  }
  document.getElementById("specialtyError").innerHTML = "";
  return true;
}

function isFacultyNumberValid() {
  if (
    !document.getElementById("faculty_number").value.match(/^[1-9][0-9]{4,10}/)
  ) {
    document.getElementById("facultyNumberError").innerHTML =
      "Please insert correct faculty number!";
    return false;
  }
  document.getElementById("facultyNumberError").innerHTML = "";
  return true;
}

function isGroupValid() {
  if (!document.getElementById("group").value.match(/^([1-9]|10)$/)) {
    document.getElementById("groupError").innerHTML =
      "Please insert a number which represents your course group!";
    return false;
  }
  document.getElementById("groupError").innerHTML = "";
  return true;
}

function showZodiacSign() {
  let birthDate = document.getElementById("birth_date").value;
  let date = new Date(birthDate);
  let month = date.getMonth() + 1;
  let day = date.getDate();
  var zodiacSign;
  if (month == months.DECEMBER) {
    if (day < 22) zodiacSign = zodiacs.SAGITTARIUS;
    else zodiacSign = zodiacs.CAPRICORN;
  } else if (month == months.JANUARY) {
    if (day < 20) zodiacSign = zodiacs.CAPRICORN;
    else zodiacSign = zodiacs.AQUARIUS;
  } else if (month == months.FEBRUARY) {
    if (day < 19) zodiacSign = zodiacs.AQUARIUS;
    else sign = zodiacs.PISCES;
  } else if (month == months.MARCH) {
    if (day < 21) zodiacSign = zodiacs.PISCES;
    else zodiacSign = zodiacs.ARIES;
  } else if (month == months.APRIL) {
    if (day < 20) zodiacSign = zodiacs.ARIES;
    else zodiacSign = zodiacs.TAURUS;
  } else if (month == months.MAY) {
    if (day < 21) zodiacSign = zodiacs.TAURUS;
    else zodiacSign = zodiacs.GEMINI;
  } else if (month == months.JUNE) {
    if (day < 21) zodiacSign = zodiacSign = zodiacs.GEMINI;
    else zodiacSign = zodiacs.CANCER;
  } else if (month == months.JULY) {
    if (day < 23) zodiacSign = zodiacs.CANCER;
    else zodiacSign = zodiacs.LEO;
  } else if (month == months.AUGUST) {
    if (day < 23) zodiacSign = zodiacs.LEO;
    else zodiacSign = zodiacs.VIRGO;
  } else if (month == months.SEPTEMBER) {
    if (day < 23) zodiacSign = zodiacs.VIRGO;
    else zodiacSign = zodiacs.LIBRA;
  } else if (month == months.OCTOBER) {
    if (day < 23) zodiacSign = zodiacs.LIBRA;
    else zodiacSign = zodiacs.SCORPIO;
  } else if (month == months.NOVEMBER) {
    if (day < 22) zodiacSign = zodiacs.SCORPIO;
    else zodiacSign = zodiacs.SAGITTARIUS;
  }

  let zodiacSignField = document.getElementById("zodiac_sign");
  zodiacSignField.value = zodiacSign;
}
