/**
 * Inquiry submission — talks to /contact.php which sits next to index.html
 * on the Hostinger server. Uses fetch + relative URL so the same build
 * works under any subdomain or root domain without rebuilding.
 */

const ENDPOINT = "contact.php";

export async function submitInquiry(payload) {
  const response = await fetch(ENDPOINT, {
    method: "POST",
    credentials: "same-origin",
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
    },
    body: JSON.stringify(payload),
  });

  let data = null;
  try {
    data = await response.json();
  } catch (_) {
    // server returned non-JSON
  }

  if (!response.ok || !data || data.ok === false) {
    const error = new Error((data && data.error) || "Submission failed.");
    error.status = response.status;
    error.detail = data && data.error;
    throw error;
  }

  return data;
}
