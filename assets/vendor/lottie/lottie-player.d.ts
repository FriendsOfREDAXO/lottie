import { LitElement, TemplateResult } from "lit-element";
export declare enum PlayerState {
    Error = "error",
    Frozen = "frozen",
    Loading = "loading",
    Paused = "paused",
    Playing = "playing",
    Stopped = "stopped"
}
export declare enum PlayMode {
    Bounce = "bounce",
    Normal = "normal"
}
export declare enum PlayerEvents {
    Complete = "complete",
    Error = "error",
    Frame = "frame",
    Freeze = "freeze",
    Load = "load",
    Loop = "loop",
    Pause = "pause",
    Play = "play",
    Ready = "ready",
    Rendered = "rendered",
    Stop = "stop"
}
/**
 * Parse a resource into a JSON object or a URL string
 */
export declare function parseSrc(src: string | object): string | object;
/**
 * LottiePlayer web component class
 *
 * @export
 * @class LottiePlayer
 * @extends {LitElement}
 */
export declare class LottiePlayer extends LitElement {
    /**
     * Animation container.
     */
    protected container: HTMLElement;
    /**
     * Play mode.
     */
    mode: PlayMode;
    /**
     * Autoplay animation on load.
     */
    autoplay: boolean;
    /**
     * Background color.
     */
    background?: string;
    /**
     * Show controls.
     */
    controls: boolean;
    /**
     * Number of times to loop animation.
     */
    count?: number;
    /**
     * Direction of animation.
     */
    direction: number;
    /**
     * Whether to play on mouse hover
     */
    hover: boolean;
    /**
     * Whether to loop animation.
     */
    loop: boolean;
    /**
     * Aspect ratio to pass to lottie-web.
     */
    preserveAspectRatio: string;
    /**
     * Renderer to use.
     */
    renderer: "svg";
    /**
     * Animation speed.
     */
    speed: number;
    /**
     * Bodymovin JSON data or URL to JSON.
     */
    src?: string;
    /**
     * Player state.
     */
    currentState: PlayerState;
    seeker: any;
    intermission: number;
    /**
     * Animation speed.
     */
    description: string;
    private _io;
    private _lottie?;
    private _prevState?;
    private _counter;
    /**
     * Handle visibility change events.
     */
    private _onVisibilityChange;
    /**
     * Handles click and drag actions on the progress track.
     */
    private _handleSeekChange;
    /**
     * Configure and initialize lottie-web player instance.
     */
    load(src: string | object): Promise<void>;
    /**
     * Returns the lottie-web instance used in the component.
     */
    getLottie(): any;
    /**
     * Start playing animation.
     */
    play(): void;
    /**
     * Pause animation play.
     */
    pause(): void;
    /**
     * Stops animation play.
     */
    stop(): void;
    /**
     * Seek to a given frame.
     */
    seek(value: number | string): void;
    /**
     * Snapshot the current frame as SVG.
     *
     * If 'download' argument is boolean true, then a download is triggered in browser.
     */
    snapshot(download?: boolean): string | void;
    /**
     * Freeze animation play.
     * This internal state pauses animation and is used to differentiate between
     * user requested pauses and component instigated pauses.
     */
    private freeze;
    /**
     * Sets animation play speed.
     *
     * @param value Playback speed.
     */
    setSpeed(value?: number): void;
    /**
     * Animation play direction.
     *
     * @param value Direction values.
     */
    setDirection(value: number): void;
    /**
     * Sets the looping of the animation.
     *
     * @param value Whether to enable looping. Boolean true enables looping.
     */
    setLooping(value: boolean): void;
    /**
     * Toggle playing state.
     */
    togglePlay(): void;
    /**
     * Toggles animation looping.
     */
    toggleLooping(): void;
    /**
     * Resize animation.
     */
    resize(): void;
    /**
     * Returns the styles for the component.
     */
    static get styles(): import("lit-element").CSSResult;
    /**
     * Initialize everything on component first render.
     */
    protected firstUpdated(): void;
    /**
     * Cleanup on component destroy.
     */
    disconnectedCallback(): void;
    protected renderControls(): TemplateResult;
    render(): TemplateResult | void;
}
//# sourceMappingURL=lottie-player.d.ts.map