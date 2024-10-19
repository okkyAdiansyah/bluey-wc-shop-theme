import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, RichText } from '@wordpress/block-editor';

registerBlockType('bluey-shop/home-banner', {
    edit({ attributes, setAttributes }) {
        const blockProps = useBlockProps();
        return (
            <RichText
                { ...blockProps }
                tagName="p"
                value={attributes.content}
                onChange={(content) => setAttributes({ content })}
                placeholder="Enter content for Block One..."
            />
        );
    },
    save({ attributes }) {
        const blockProps = useBlockProps.save();
        return <RichText.Content { ...blockProps } tagName="p" value={attributes.content} />;
    }
});