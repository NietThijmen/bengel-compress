export interface AjaxResponse<T = any> {
    success: boolean;
    data: T;
}