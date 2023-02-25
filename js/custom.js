const $ = jQuery;

const $subCats = $(".flatsome-sub-category");

if ($subCats.length > 0) {
  const $shopContainer = $(".shop-container");

  const $sub_cat_heading = $(
    `<h3 class="section-title section-title-center">SUB CATEGORIES</h3>`
  );

  const $select = $("<select></select>").append(
    $('<option value="">Please Select...</option>')
  );

  for (let i = 0; i < $subCats.length; i++) {
    const text = $($subCats[i]).find("h5").text();
    const url = $($subCats[i]).find("a").attr("href");
    $select.append($(`<option value="${url}">${text}</option>`));
  }

  $select.on("change", function () {
    window.location.href = $(this).val();
  });

  $shopContainer.prepend($select);
  $shopContainer.prepend($sub_cat_heading);
}
