import React from "react";
import {json, Link} from "react-router-dom";
import {toast} from "react-toastify";
import logImg from "../img/loginbg.jpg";
function Login() {
  const [userData, setUserData] = React.useState({
    username: "",
    password: ""
  });
  function onChange(e) {
    setUserData((prevState) => ({
      ...prevState,
      [e.target.id]: e.target.value
    }));
  }
  async function LogUser() {
    if (!userData.username || !userData.password) {
      return toast.error("Veuillez entrer les informations...");
    }
    var urlencoded = new URLSearchParams();
    urlencoded.append("username", userData.username);
    urlencoded.append("password", userData.password);

    await fetch(
      `${window.location.protocol}//${window.location.hostname}:86/api/client-login`,
      {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: urlencoded
      }
    ).then(async (response) => {
      if (response.status === 200) {
        const data = await response.json();
        sessionStorage.setItem("session", data[0].token);
        sessionStorage.setItem("userData", JSON.stringify(data));
        toast.success("User connect succesfully");
      } else toast.error("Informations incorrects");
    });
  }
  return (
    <div className='lg:mx-32'>
      <div className='flex lg:flex-row items-center'>
        <div>
          <img src={logImg} alt='login'></img>
        </div>
        <div className='flex-shrink-0 lg:w-1/2 w-full'>
          <div className='card-body'>
            <h2 className='text-3xl font-bold'>Veuillez-vous connecter</h2>
            <div className='form-control'>
              <label className='label'>
                <span className='label-text'>Numero de téléphone</span>
              </label>
              <input
                type='text'
                id='username'
                placeholder='Numero'
                className='input input-bordered'
                onChange={onChange}
                value={userData.username}
              />
            </div>
            <div className='form-control'>
              <label className='label'>
                <span className='label-text'>Mot de passe</span>
              </label>
              <input
                type='password'
                id='password'
                placeholder='Mot de passe'
                className='input input-bordered'
                onChange={onChange}
                value={userData.password}
              />
              <label className='label'>
                <Link to='#/' className='label-text-alt link link-hover'>
                  Forgot password?
                </Link>
                <Link to='/register' className='label-text-alt link link-hover'>
                  Créer un compte
                </Link>
              </label>
            </div>
            <div className='form-control mt-6'>
              <button className='btn btn-primary' onClick={LogUser}>
                Connexion
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Login;
