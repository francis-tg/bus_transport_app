export async function checkBeforeLaunch() {
  if (
    sessionStorage.getItem("session") ||
    sessionStorage.getItem("session").length > 0
  ) {
    const urlencoded = new URLSearchParams();
    urlencoded.append("token", sessionStorage.getItem("session"));
    await fetch(
      `${window.location.protocol}//${window.location.hostname}:86/api/check-user`,
      {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: urlencoded
      }
    ).then((response) => {
      if (response.status === 200) {
        return true;
      }
      return false;
    });
    return false;
  }
  return false;
}
