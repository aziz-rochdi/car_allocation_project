// The folowing script is to keep shopping cart visible when we click on it

$(document).ready(function () {
  $("#cart-menu").on("click", function (event) {
    event.stopPropagation();
    $(this).parent().addClass("show");
  });
});

const readURL = (input) => {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $(".modal .profile-img img").attr("src", e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
};

$("#changepdp").on("change", function () {
  readURL(this);
});

$(".saveProfileChanges").click(function () {
  $("#saveProfileChanges").click();
});

$(".editProfile").click(function () {
  //get the data from the table to the modal
  var data = $(this).parentsUntil("table");
  var image = $("#userProfileImage").attr("src");
  var firstName = $(data).find(".firstNameField").text();
  var lastName = $(data).find(".lastNameField").text();
  var email = $(data).find(".emailField").text();
  var address = $(data).find(".addressField").text();
  var phone = $(data).find(".phoneField").text();

  $("#user-ProfileImage").attr("src", image);
  $("#user-firstName").val(firstName);
  $("#user-lastName").val(lastName);
  $("#user-emailAddress").val(email);
  $("#user-Address").text(address);
  $("#user-phone").val(phone);
});

$(".profile-head .name h4").text(
  $(".firstNameField").text() + " " + $(".lastNameField").text()
);

// Product
$(".delete").on("click", function () {
  var selectedCard = $(this).parent().parent().parent().parent();
  $(".delete-confirmed").on("click", function () {
    console.log("delete confirmed <clicked>");
    $(selectedCard).remove();
    console.log("item deleted");
  });
});

// update photo

const readURLProduct = (input) => {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $("#editProductModal .img-thumbnail").attr("src", e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
};

$("#editProductImage").on("change", function () {
  readURLProduct(this);
});

// save change button
$("#saveChanges").on("click", function () {
  $("#saveProductChanges").click();
});

$("#saveProductChanges").on("click", function () {
  console.log("product info changed succesfuly");
});

// Get the info from product to edit modal

$(".editProduct").click(function (event) {
  event.preventDefault();
  // get the id of selected item
  var parentsList = $(this).parents();
  var idProduct = $(parentsList[2]).children(".card-body").attr("id");
  console.log("Selected product id : " + idProduct);
  selectedIdForDetail = idProduct;

  var title = $("#" + idProduct)
    .find(".title")
    .text();
  var category = $("#" + idProduct).attr("category");
  category = category.toLowerCase();
  console.log("cat: " + category);
  var imageSrc = $("#" + idProduct)
    .find("img")
    .attr("src");
  var price = parseFloat(
    $("#" + idProduct)
      .find(".productPrice span")
      .text()
  );

  // Put the info in the detail modal

  $(".product-img .img-thumbnail").attr("src", imageSrc);
  $(".product-content #product-title").val(title);

  // $(".product-content #edit-Category option[value='"+category+"']").attr('value',category + ' selected');

  // Description is not yet ready

  $(".product-content #product-Price").val(price);

  // model not yet ready

  // color code should be in the database
});

// Detail modal

var selectedIdForDetail = 0;

$(".detail").click(function (event) {
  event.preventDefault();
  // get the id of selected item
  var parentsList = $(this).parents();
  var idProduct = $(parentsList[2]).children(".card-body").attr("id");
  console.log("Selected product id : " + idProduct);
  selectedIdForDetail = idProduct;

  var title = $("#" + idProduct)
    .find(".title")
    .text();
  var category = $("#" + idProduct).attr("category");
  var imageSrc = $("#" + idProduct)
    .find("img")
    .attr("src");
  var price = parseFloat(
    $("#" + idProduct)
      .find(".productPrice span")
      .text()
  );

  // Put the info in the detail modal

  $(".modal .modal-body .large-image img").attr("src", imageSrc);
  $(".modal .modal-body .title-cat .title").text(title);
  $(".modal .modal-body .title-cat p").text(category);

  // Description is not yet ready

  $(".modal .modal-body .product-info .price strong").text(price);

  // model not yet ready

  // color code should be in the database
});

// update photo

const uploadProductImage = (input) => {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $("#addProductModal .img-thumbnail").attr("src", e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
};

$("#addProductImage").on("change", function () {
  uploadProductImage(this);
});

$(".addNewProduct").click(function () {
  $("#addNewProduct").click();
});
