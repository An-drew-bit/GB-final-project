import React, { useState, useEffect } from "react";
import { Link, useNavigate } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import './signUp.scss';
import { signUpUserTrunk, signUpUserServicesTrunk, setErrorAction } from "../../store/userAuth";
import {ErrorField} from "../../components/ErrorField";
import {getErrors} from "../../store/userAuth/selectors";
export const SignUp = () => {
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [confirmation, setConfirmation] = useState("");
  const errorList = useSelector(getErrors);
  const dispatch = useDispatch();
  const navigate = useNavigate();
  useEffect(()=>{
    dispatch(setErrorAction('') )
  },[])

  function nameSubmitHandler(event) {
    setName(event.target.value);
  }
  function emailSubmitHandler(event) {
    setEmail(event.target.value);
  }
  function passwordSubmitHandler(event) {
    setPassword(event.target.value);
  }
  function confirmationSubmitHandler(event) {
    setConfirmation(event.target.value);
  }
  function clearForm() {
    setName("");
    setEmail("");
    setPassword("");
    setConfirmation("");
  }

  async function signUpHandler(event) {
    console.log("signUpHandler")
    event.preventDefault();
    const signUperror = await dispatch(signUpUserTrunk({name, email, password, confirmation}));
    console.log("signUperror" + {signUperror})
    console.log("errorList",errorList)
    if (signUperror) {
      return
    } else {
      clearForm();
      navigate("/articles/all");
    }
  }

  async function signUpServices(event) {
    console.log("signUpService")
    event.preventDefault();
    const signUperror = await dispatch(signUpUserServicesTrunk('github'));
    console.log("errorList",errorList)
    if (signUperror) {
      return
    } else {
      navigate("/articles/all");
      clearForm();
    }
  }

  return (
    <section className="page-wrapper">
      <div className="login-page">
        <form onSubmit={signUpHandler}>
          <div className="login-page-text">??????????????????????</div>
          <div className="form">
            <div className="text-field">
              <label className="text-field__label" >??????</label>
              <input className="text-field__input" id="name" type="text" placeholder="???????????????????? ??????"
                value={name}
                onChange={nameSubmitHandler}
                required
              />
            </div>
            <div className="text-field">
              <label className="text-field__label" >Email</label>
              <input className="text-field__input" id="email" type="email" placeholder="?????????????? email"
                value={email}
                onChange={emailSubmitHandler}
                required
              />
            </div>
            <div className="text-field">
              <label className="text-field__label" >????????????</label>
              <input className="text-field__input" id="password" type="password" placeholder="?????????????? ????????????"
                value={password}
                onChange={passwordSubmitHandler}
                required
              />
            </div>
            <div className="text-field">
              <label className="text-field__label" >?????????????????? ????????????</label>
              <input className="text-field__input" id="password_repeat" type="password" placeholder="?????????????????? ????????????"
                value={confirmation}
                onChange={confirmationSubmitHandler}
                required
              />
            </div>
            <div className="remember-me">
              <div className="text-login">
                <Link to="/login"> 
                  <p>?????? ???????? ???????????????</p>
                </Link>
              </div>
            </div>
            <input className="btn" type="submit" value="????????????????????????????????????"/> 
            <div>
              <p>C ?????????????? ??????????????</p>
              <div className="github" title="Github" onClick = {signUpServices}>
                
              </div>
            </div>
            {
              errorList &&
               <ErrorField error={errorList}/>
            }
          </div>
        </form>
      </div>
    </section>
  );
};
