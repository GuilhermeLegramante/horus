/*!
 * FilePondPluginFileValidateType 1.2.8
 * Licensed under MIT, https://opensource.org/licenses/MIT/
 * Please visit https://pqina.nl/filepond/ for details.
 */ !function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):(e=e||self).FilePondPluginFileValidateType=t()}(this,function(){"use strict";var e=function e(t){var n=t.addFilter,i=t.utils,T=i.Type,E=i.isString,r=i.replaceInString,l=i.guesstimateMimeType,a=i.getExtensionFromFilename,u=i.getFilenameFromURL,o=function e(t,n){var i;return(/^[^/]+/.exec(t)||[]).pop()===n.slice(0,-2)},c=function e(t,n){return t.some(function(e){return/\*$/.test(e)?o(n,e):e===n})},p=function e(t){var n="";if(E(t)){var i=u(t),T=a(i);T&&(n=l(T))}else n=t.type;return n},f=function e(t,n,i){if(0===n.length)return!0;var T=p(t);return i?new Promise(function(e,E){i(t,T).then(function(t){c(n,t)?e():E()}).catch(E)}):c(n,T)};return n("SET_ATTRIBUTE_TO_OPTION_MAP",function(e){return Object.assign(e,{accept:"acceptedFileTypes"})}),n("ALLOW_HOPPER_ITEM",function(e,t){var n=t.query;return!n("GET_ALLOW_FILE_TYPE_VALIDATION")||f(e,n("GET_ACCEPTED_FILE_TYPES"))}),n("LOAD_FILE",function(e,t){var n=t.query;return new Promise(function(t,i){if(!n("GET_ALLOW_FILE_TYPE_VALIDATION")){t(e);return}var T=n("GET_ACCEPTED_FILE_TYPES"),E=n("GET_FILE_VALIDATE_TYPE_DETECT_TYPE"),l=f(e,T,E),a=function e(){var t,E=T.map((t=n("GET_FILE_VALIDATE_TYPE_LABEL_EXPECTED_TYPES_MAP"),function(e){return null!==t[e]&&(t[e]||e)})).filter(function(e){return!1!==e}),l=E.filter(function(e,t){return E.indexOf(e)===t});i({status:{main:n("GET_LABEL_FILE_TYPE_NOT_ALLOWED"),sub:r(n("GET_FILE_VALIDATE_TYPE_LABEL_EXPECTED_TYPES"),{allTypes:l.join(", "),allButLastType:l.slice(0,-1).join(", "),lastType:l[E.length-1]})}})};if("boolean"==typeof l)return l?t(e):a();l.then(function(){t(e)}).catch(a)})}),{options:{allowFileTypeValidation:[!0,T.BOOLEAN],acceptedFileTypes:[[],T.ARRAY],labelFileTypeNotAllowed:["File is of invalid type",T.STRING],fileValidateTypeLabelExpectedTypes:["Expects {allButLastType} or {lastType}",T.STRING],fileValidateTypeLabelExpectedTypesMap:[{},T.OBJECT],fileValidateTypeDetectType:[null,T.FUNCTION]}}};return"undefined"!=typeof window&&void 0!==window.document&&document.dispatchEvent(new CustomEvent("FilePond:pluginloaded",{detail:e})),e});