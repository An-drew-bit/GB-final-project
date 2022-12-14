import { StarRateTwoTone } from "@mui/icons-material";
import {
    SET_ARTICLES_ALL, 
    SET_ARTICLE, SET_ARTICLES_NULL, 
    SET_ARTICLE_PASSING, 
    SET_ARTICLE_PASSING_NULL,
    SET_ARTICLES_PAGES_URL,
    SET_ARTICLE_COUNT_COMMENTS,
    SET_ARTICLE_LIKE_AMOUNT,
    SET_ARTICLE_BOOKMARK_TOOGLE,
    SET_ARTICLES_ID_BOOKMARK_TOOGLE,
    SET_LINKS_PAGINATION
} from "./actions";


let dateTransition = new Date()  // текущая дата для изменения
       

const initialState = {
    articles: [], //массив статей
    article: {}, // объект статья
    articlePassing: '', // ссылка на статью с корой ушли на авторизацию
    pagesUrl: '' // параметр запроса (url) для пагинации
}

export const articlesReducer = (state = initialState, { type, payload }) => {
   
    switch (type) {
        case SET_ARTICLES_ALL: {
            console.log("articlesReducer", payload)
            return {
                ...state,
                articles:payload
            }
        }
        
        case SET_ARTICLE: {
            // console.log("articleReducer", payload)
            return {
                ...state,
                article:{...payload}
            }
        }
        case SET_ARTICLES_NULL: {
            // console.log("articlesNullReducer", payload)
            return {
                ...state,
                articles:[]
            }
        }
        case SET_ARTICLE_PASSING: {
            // console.log("aArticlePassingReducer", payload)
            return {
                ...state,
                articlePassing:  payload
            }
        }
        case SET_ARTICLE_PASSING_NULL: {
            // console.log("aArticlePassingReducer", payload)
            return {
                ...state,
                articlePassing: ''
            }
        }
        case SET_ARTICLES_PAGES_URL: {
            // console.log("SET_ARTICLES_PAGES_URL Reducer - ", payload)
            return {
                ...state,
                pagesUrl: payload
            }
        }
        case SET_ARTICLE_COUNT_COMMENTS: {
            return {
                ...state,
                article: {...state.article, count_comments: payload}
            }
        }
        case SET_ARTICLE_LIKE_AMOUNT: {
            return {
                ...state,
                article: {...state.article, likes: payload, auth_liked:!state.article.auth_liked }
            }
        }
        case SET_ARTICLE_BOOKMARK_TOOGLE: {
            return {
                ...state,
                article: {...state.article, count_bookmarks: payload, auth_bookmarks: !state.article.auth_bookmarks
                }
            }
        }
        case SET_ARTICLES_ID_BOOKMARK_TOOGLE: {
            const arr = {...state.articles}
            arr.data.articles[payload.num].count_bookmarks = payload.amount
            arr.data.articles[payload.num].auth_bookmarks = !arr.data.articles[payload.num].auth_bookmarks
            return {
                ...state,  
                articles: {...arr}
            }
        }
        case SET_LINKS_PAGINATION: {
            const arr = {...state.articles}
           // arr.meta = payload
            console.log('links: payload', payload)
            return {
                ...state,  
               articles: {...state.articles, meta: payload}
            }
        }
        default:{
            return state;
        }
    }
}