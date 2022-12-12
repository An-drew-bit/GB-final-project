import React, {useEffect} from 'react';
import { useDispatch } from "react-redux";

import { getDbArticlesAll, setArticlesPagesUrl} from "../../store/articles"
import ArticlesList from '../../components/Articles/ArticlesList';

function All() {
  const dispatch = useDispatch(); 
  
  useEffect(()=> {
    console.log("articles dispatch All")
    window.scroll(0, 0);
    dispatch( getDbArticlesAll(`/api/articles?sort=created_at`));
    dispatch(setArticlesPagesUrl('api/articles?sort=created_at&'))
  },[]) 

  return (
      <>
        <div className="pages-header">
          <h3 >ALL</h3> 
        </div>
        <ArticlesList />
      </>
    );
  }
  
export default All;