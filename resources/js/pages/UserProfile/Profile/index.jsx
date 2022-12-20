import React, {useEffect} from 'react';
import { useDispatch, useSelector } from "react-redux";
import ArticlesList from '../../../components/Articles/ArticlesList';
import { getDbArticlesUserProfile, setArticlesPagesUrl} from "../../../store/articles"
import { getToken} from "../../../store/userAuth"

function UserProfileProfile() {
   const dispatch = useDispatch();
   const token = useSelector(getToken)
  //  useEffect(()=> {
  //     console.log("articles user profile")
  //     dispatch( getDbArticlesUserProfile({url:'/api/profile/articles', token}) );
  //     dispatch( setArticlesPagesUrl(`/api/profile/articles?`) )
  //  },[]) 

  return (
      <>
        <div className="pages-header">
          <h3 >Profile</h3> 
        </div>
        
      </>
    );
  }
  
export default UserProfileProfile;

