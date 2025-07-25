document.getElementById("track-form").addEventListener("submit", function (e) {
    e.preventDefault();

    const regId = document.getElementById("registration_id").value.trim();
    const resultDiv = document.getElementById("track-result");

    if (!regId) {
        resultDiv.innerHTML =
            '<p class="text-danger">Please enter a Registration ID.</p>';
        return;
    }

    resultDiv.innerHTML = "<p>Loading...</p>";

    fetch(
        `{{ route('track.document') }}?registration_id=${encodeURIComponent(
            regId
        )}`
    )
        .then((response) => response.json())
        .then((data) => {
            if (!data.status) {
                resultDiv.innerHTML = `<p class="text-danger">${
                    data.message ?? "Document not found."
                }</p>`;
                return;
            }

            // --- Mapping status dari server ke index langkah ---
            const statusRaw = (data.data.latest_status || "")
                .toString()
                .trim()
                .toLowerCase();
            let currentStep = 0;
            switch (statusRaw) {
                case "submitted":
                case "submited": // toleransi typo
                    currentStep = 0;
                    break;
                case "in review":
                case "review":
                    currentStep = 1;
                    break;
                case "in process":
                case "on process":
                case "on progres":
                case "processing":
                    currentStep = 2;
                    break;
                case "completed":
                case "complete":
                case "done":
                    currentStep = 3;
                    break;
                default:
                    currentStep = 0;
            }

            const steps = [
                {
                    label: "Submitted",
                },
                {
                    label: "In Review",
                },
                {
                    label: "In Process",
                },
                {
                    label: "Completed",
                },
            ];

            // Hitung width progress bar (0%, 33%, 66%, 100%) relatif ke jumlah step
            const progressPercent = (currentStep / (steps.length - 1)) * 100;

            // Build markup timeline
            const timelineHtml = `
                    <div class="p-4 border rounded-4">
                        <div class="mb-4 text-center">
                            <h3 class="fs-5 mb-1">${
                                data.data.document_type ?? "Document"
                            }</h3>
                            <small class="text-muted">Registration: ${regId}</small>
                        </div>
                        <div class="doc-timeline">
                            ${steps
                                .map((s, idx) => {
                                    const stateClass =
                                        idx < currentStep
                                            ? "completed"
                                            : idx === currentStep
                                            ? "current"
                                            : "";
                                    return `
                                    <div class="doc-step ${stateClass}">
                                        <div class="doc-step-circle">${
                                            idx + 1
                                        }</div>
                                        <div class="doc-step-label">${
                                            s.label
                                        }</div>
                                    </div>
                                `;
                                })
                                .join("")}
                        </div>
                        ${
                            data.data.file
                                ? `<a href="/file/documents/${data.data.file}" class="btn btn-outline-primary" download>Download File</a>`
                                : ``
                        }
                    </div>
                `;

            resultDiv.innerHTML = timelineHtml;
        })
        .catch(() => {
            resultDiv.innerHTML = `<p class="text-danger">Something went wrong!</p>`;
        });
});
