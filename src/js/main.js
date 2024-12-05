$(document).ready(function () {
  function generateMVP() {
    let mvpData = $("#mvp-data").text();
    if (mvpData === "No MVP data available") {
      alert("No MVP data available");
      return;
    }

    let [name, jobTitle, rating] = mvpData.split("|");
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.setFont("times", "normal");
    doc.setFillColor(255, 223, 186);
    doc.rect(10, 10, 190, 277, "F");
    doc.setDrawColor(255, 215, 0);
    doc.setLineWidth(3);
    doc.rect(10, 10, 190, 277);

    doc.setFontSize(28);
    doc.setTextColor(0, 0, 0);
    doc.text("MVP of the Year 🏆", 105, 40, null, null, "center");

    doc.setLineWidth(0.5);
    doc.line(20, 65, 190, 65);

    doc.setFontSize(20);
    doc.setTextColor(0, 102, 204);
    doc.text("Congratulations!", 105, 90, null, null, "center");

    doc.setFontSize(18);
    doc.setTextColor(0, 0, 0);
    doc.text("Name: " + name, 20, 110);
    doc.text("Job Title: " + jobTitle, 20, 120);
    doc.text("Rating: " + rating, 20, 130);

    doc.setFontSize(12);
    doc.text("_________________________", 105, 170, null, null, "center");
    doc.text("Signature", 105, 175, null, null, "center");

    const currentDate = new Date();
    const formattedDate = currentDate.toLocaleDateString();
    doc.text("Issued on: " + formattedDate, 105, 190, null, null, "center");

    doc.save("MVP_Certificate_" + name.replace(/\s+/g, "_") + ".pdf");
  }

  function generateCertificate(categoryId) {
    let winner = null;
    $("#" + categoryId + " .result-text").each(function () {
      let text = $(this).text();
      if (text.includes("🥇")) {
        let [name, jobTitle, rating] = text.split(" - ");
        winner = { name, jobTitle, rating };
      }
    });

    if (winner) {
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF();

      doc.setFont("times", "normal");
      doc.setFillColor(240, 240, 240);
      doc.rect(10, 10, 190, 277, "F");
      doc.setDrawColor(0, 0, 0);
      doc.setLineWidth(3);
      doc.rect(10, 10, 190, 277);

      doc.setFontSize(22);
      doc.setTextColor(0, 0, 128);
      doc.text("Certificate of Achievement", 105, 40, null, null, "center");

      doc.setFontSize(18);
      doc.setTextColor(0, 0, 0);
      doc.text(
        "Category: " + categoryId.replace("-", " "),
        105,
        60,
        null,
        null,
        "center"
      );

      doc.setLineWidth(0.5);
      doc.line(20, 65, 190, 65);

      doc.setFontSize(16);
      doc.setTextColor(0, 102, 204);
      doc.text("1st Place", 105, 85, null, null, "center");

      doc.setFontSize(14);
      doc.setTextColor(0, 0, 0);
      doc.text("Name: " + winner.name, 20, 105);
      doc.text("Job Title: " + winner.jobTitle, 20, 115);
      doc.text("Rating: " + winner.rating, 20, 125);

      doc.setFontSize(12);
      doc.text("_________________________", 105, 170, null, null, "center");
      doc.text("Signature", 105, 175, null, null, "center");

      const currentDate = new Date();
      const formattedDate = currentDate.toLocaleDateString();
      doc.text("Issued on: " + formattedDate, 105, 190, null, null, "center");

      doc.save("Certificate_" + winner.name.replace(/\s+/g, "_") + ".pdf");
    } else {
      alert(
        "No first-place winner found for this category. Insert more votes in this category!"
      );
    }
  }

  function checkCategoryVotes(categoryId) {
    let noVotes = true;
    $("#" + categoryId + " .result-text").each(function () {
      if (
        $(this).text().includes("🥇") ||
        $(this).text().includes("🥈") ||
        $(this).text().includes("🥉")
      ) {
        noVotes = false;
      }
    });

    if (noVotes) {
      $("#" + categoryId + " .generate-btn")
        .attr("disabled", true)
        .text("No votes yet");
    }
  }

  $("#generate-mvp-btn").click(function () {
    generateMVP();
  });

  $(".generate-btn").click(function () {
    let categoryId = $(this).attr("id").replace("generate-btn-", "");
    generateCertificate(categoryId);
  });

  checkCategoryVotes("makes-work-fun");
  checkCategoryVotes("team-player");
  checkCategoryVotes("culture-champion");
  checkCategoryVotes("difference-maker");
});
