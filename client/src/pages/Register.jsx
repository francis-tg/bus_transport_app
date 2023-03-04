import React from "react";
import {Link} from "react-router-dom";

function Register() {
  return (
    <div className='mx-32'>
      <div className='flex flex-row items-center'>
        <div>
          <figure>
            <img src={logImg}></img>
          </figure>
        </div>
        <div className='flex-shrink-0 w-1/2 '>
          <div className='card-body'>
            <h2 className='text-3xl font-bold'>Veuillez-vous connecter</h2>
            <div className='form-control'>
              <label className='label'>
                <span className='label-text'>Nom</span>
              </label>
              <input
                type='text'
                placeholder='email'
                className='input input-bordered'
              />
            </div>
            <div className='form-control'>
              <label className='label'>
                <span className='label-text'>Prenom</span>
              </label>
              <input
                type='text'
                placeholder='email'
                className='input input-bordered'
              />
            </div>
            <div className='form-control'>
              <label className='label'>
                <span className='label-text'>Contact</span>
              </label>
              <input
                type='text'
                placeholder='email'
                className='input input-bordered'
              />
            </div>
            <div className='form-control'>
              <label className='label'>
                <span className='label-text'>Password</span>
              </label>
              <input
                type='text'
                placeholder='password'
                className='input input-bordered'
              />
              <label className='label'>
                <a href='#' className='label-text-alt link link-hover'>
                  Forgot password?
                </a>
                <Link to='/login' className='label-text-alt link link-hover'>
                  Connecter plutot
                </Link>
              </label>
            </div>
            <div className='form-control mt-6'>
              <button className='btn btn-primary'>Login</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Register;
