import Ajax from "./Ajax";
import type {AjaxResponse} from "@/Interfaces/AjaxResponse";
import type CompressionSettings from "@/Interfaces/CompressionSettings";

export default class CompressionSettingsApi extends Ajax{

    public save(data: CompressionSettings): Promise<any> {
        return this.post('bengel_compress_save_image_settings', {
            data: JSON.stringify(data),
        });
    }

    public fetch(): Promise<AjaxResponse<CompressionSettings>> {
        return this.post('bengel_compress_get_image_settings', {});
    }
}