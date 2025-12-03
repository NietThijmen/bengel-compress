/**
 * Base AJAX connector for WordPress backend
 * @author Thijmen Rierink <thijmen@bengelmedia.nl>
 */
export default class Ajax {
    public endpoint: string;

    constructor() {
        // @ts-ignore -- Injected by WP
        this.endpoint = window.bengelCompress.ajaxUrl;
    }


    /**
     * Base AJAX POST request method
     * @param action
     * @param data
     */
    public async post(action: string, data: Record<string, any> = {}): Promise<any> {
        data.action = action;


        console.info(
            `[AJAX] POST Request to action "${action}" with data:`,
            data
        )

        const response = await fetch(this.endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
            },
            body: new URLSearchParams(data as Record<string, string>)
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        return await response.json();
    }
}